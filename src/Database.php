<?php
namespace App;

use PDO;

require_once 'config.php';

class Database
{
    /**Function tries to connect to database using PDO.
     * @param string $dsn
     * @param array $pdoOptions
     * @return PDO
     */
    function connect(string $dsn, array $pdoOptions): PDO
    {
        try {
            $pdo = new PDO($dsn, PARAMS['USER'], PARAMS['PASSWORD'], $pdoOptions);
        } catch (\PDOException $e) {
            var_dump($e->getCode());
            throw new \PDOException($e->getMessage());
        }

        return $pdo;
    }
    public function addUser
    (
        string $username,
        string $email,
        string $password,
        string $firstName,
        string $lastName,
        string $phone,
        string $activationCode,
        int $admin = 0
    ): void
    {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $GLOBALS['pdo']->prepare("
                                INSERT INTO users (username, email, password, first_name, last_name, phone, admin, activation_code) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?)
                                ");
        $stmt->execute([
            $username,
            $email,
            $hashedPassword,
            $firstName,
            $lastName,
            $phone,
            $admin,
            $activationCode
        ]);
    }

    /**
     * @param string $username
     * @return array|false
     */
    public function retrieveUserData(string $username): array|false
    {
        $stmt = $GLOBALS['pdo']->prepare("SELECT * FROM users WHERE username=?");
        $stmt->execute([$username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * @param string $username
     * @param bool $org
     * @return void
     */
    public function activateUser(string $username, bool $org = false): void
    {
        $stmt = (!$org) ? $GLOBALS['pdo']->prepare("UPDATE users SET active = 1 WHERE username=?") : $GLOBALS['pdo']->prepare("UPDATE organisations SET active = 1 WHERE email = ?");
        $stmt -> execute([$username]);
    }

    /**
     * @param string $brn
     * @param string $name
     * @param string $email
     * @param string $phone
     * @param string $country
     * @param int $cityId
     * @param string $address
     * @param string $password
     * @param string $activationCode
     * @return void
     */
    public function addOrganisation
    (
        string $brn,
        string $name,
        string $email,
        string $phone,
        string $country,
        int $cityId,
        string $address,
        string $password,
        string $activationCode
    ): void
    {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $stmt = $GLOBALS['pdo']->prepare
    (
            "INSERT INTO organisations(brn, org_name, email, phone, country, city_id, address, password, activation_code) VALUES (?,?,?,?,?,?,?,?,?)"
        );
        $stmt->execute([$brn, $name, $email, $phone, $country, $cityId, $address, $hashedPassword, $activationCode]);
    }
    public function retrieveOrgData($input , string $filter = ''): array|false
    {
        $stmt = match ($filter) {
            'id' => $GLOBALS['pdo']->prepare("SELECT * FROM organisations WHERE org_id=?"),
            default => $GLOBALS['pdo']->prepare("SELECT * FROM organisations WHERE email=?"),
        };
        $stmt->execute([$input]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * @param array $sights
     * @return string
     */
    public function retrieveCountryFromOrg(array $sights): string
    {
        $sight = $sights[0];
        $stmt = $GLOBALS['pdo']->prepare("SELECT o.country AS country FROM organisations o INNER JOIN sights s ON s.org_id=o.org_id WHERE s.sight_id=?");
        $stmt->execute([$sight]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return !empty($result) ? $result['country'] : "Error has occurred";
    }

    /**
     * @param int $sightId
     * @return array|false
     */
    public function retrieveSightData(int $sightId): array|false
    {
        $stmt = $GLOBALS['pdo']->prepare("SELECT * FROM sights WHERE sight_id=?");
        $stmt->execute([$sightId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * @param $table
     * @param $column
     * @param $value
     * @return bool
     */
    public function deleteQuery($table, $column, $value): bool
    {
        $stmt = $GLOBALS['pdo']->prepare("DELETE FROM " . $table . " WHERE " . $column . " = ?");
        $stmt->execute([$value]);

        return $stmt->rowCount() > 0;
    }

    /**
     * @return array
     */
    public function retrieveCategories(): array
    {
        $stmt = $GLOBALS['pdo']->prepare("SELECT * FROM categories");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $arr = [];

        foreach($result as $value){
            $arr[$value['category_id']] = $value['category_name'];
        }

        return $arr;
    }

    /**
     * @param int $id
     * @return string
     */
    public function retrieveCategoryById(int $id): string
    {
        $stmt = $GLOBALS['pdo']->prepare("SELECT category_name FROM categories WHERE category_id = ?");
        $stmt->execute([$id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return ($result) ? $result['category_name'] : 'Error has occurred';
    }

    /**
     * @param string $country
     * @return array|false
     */
    public function retrieveCityByCountryArray(string $country): array|false
    {
        $stmt = $GLOBALS['pdo'] ->prepare("SELECT * FROM cities WHERE country=?");
        $stmt->execute([$country]);

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $arr = [];

        foreach($result as $value){
            $arr[$value['city_id']] = $value['city_name'];
        }
        return $arr;
    }

    /**
     * @param $input
     * @param string $filter
     * @param bool $single
     * @return array|string|int
     */
    public function retrieveCity(
        $input,
        string $filter = '',
        bool $single = false
    ): array|string|int
    {
        $stmt = match ($filter)
        {
            'id' => $GLOBALS['pdo']->prepare("SELECT * FROM cities WHERE city_id=?"),
            'name' => $GLOBALS['pdo']->prepare("SELECT * FROM cities WHERE city_name=?"),
            'country' => $GLOBALS['pdo']->prepare("SELECT * FROM cities WHERE country=?"),
            default => $GLOBALS['pdo']->prepare("SELECT * FROM cities"),
        };
    $stmt ->execute([$input]);

    return ($single) ? $stmt->fetch(PDO::FETCH_ASSOC) : $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param int $orgID
     * @param string $name
     * @param string $description
     * @param $photo
     * @param int $category_id
     * @param string $latitude
     * @param string $longitude
     * @param int $city
     * @param string $address
     * @return bool
     */
    public function addSight
    (
        int $orgID,
        string $name,
        string $description,
        $photo,
        int $category_id,
        string $latitude,
        string $longitude,
        int $city,
        string $address
    ): bool
    {
        if(is_uploaded_file($photo['tmp_name']) && exif_imagetype($photo['tmp_name']) ) {
            $extension = explode('/', $_FILES["photo"]["type"])[1];
            if(!in_array($extension, $GLOBALS['imageTypes']))
            {
                header("Location:profile");
                exit();
            }
            $newName = uniqid("org", true) . "-sight-" .  mt_rand(100, 999999) . "." . $extension;
            if(move_uploaded_file($photo['tmp_name'], "../../assets/images/sight/".$newName))
            {
                $stmt = $GLOBALS['pdo']->prepare("
                    INSERT INTO sights(org_id, sight_name, description, photo, category_id, latitude, longitude, address, city_id)
                    VALUES (?,?,?,?,?,?,?,?,?)
                    ");
               return ($stmt->execute([$orgID, $name, $description, $newName, $category_id, $latitude, $longitude, $address, $city]));
            }
        }
        return false;
    }

    /**
     * @param int $id
     * @param string $parameter
     * @param int $count
     * @return string[]
     */
    public function retrieveSightDataOrg
    (
        int $id,
        string $parameter = '',
        int $count = 3,
    ): array
    {
        $stmt = match ($parameter)
        {
            'recent' => $GLOBALS['pdo']->prepare("SELECT * FROM sights WHERE org_id = ? ORDER BY sight_id DESC LIMIT ?"),
            'favourite' => $GLOBALS['pdo']->prepare("SELECT * FROM sights WHERE org_id = ? ORDER BY popularity DESC LIMIT ?"),
            default => $GLOBALS['pdo']->prepare("SELECT * FROM sights WHERE org_id = ? LIMIT ?")
        };
        $stmt->execute([$id, $count]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return (!empty($result)) ? $result : ['No sights?'];
    }

    /**
     * @param int $id
     * @param int $limit
     * @return array|string[]
     */
    public function retrieveFavourites(int $id, int $limit = 3): array
    {
        $stmt = $GLOBALS['pdo']->prepare("SELECT * FROM favorites WHERE user_id = ? ORDER BY fav_id DESC LIMIT ?");
        $stmt->execute([$id, $limit]);
        $favourites = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $result = [];

        for($i = 0; $i < count($favourites); $i++)
        {
            $stmt2 = $GLOBALS['pdo']->prepare("SELECT * FROM sights WHERE sight_id = ?");
            $stmt2->execute([$favourites[$i]['sight_id']]);
            $result[$i] = $stmt2->fetch(PDO::FETCH_ASSOC);
        }
        return (!empty($result)) ? $result : ['No sights?'];
    }

    /**
     * @param int $id
     * @param int $limit
     * @return string[]
     */
    public function retrieveTours(int $id, int $limit = 3): array
    {
        $stmt = $GLOBALS['pdo']->prepare("SELECT * FROM custom_tours WHERE user_id = ? ORDER BY tour_id DESC LIMIT ?");
        $stmt->execute([$id, $limit]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return (!empty($result)) ? $result : ['No sights?'];
    }

    /**
     * @param int $tourId
     * @return mixed
     */
    public function retrieveTourImage(int $tourId): mixed
    {
        $stmt = $GLOBALS['pdo']->prepare(
            "SELECT photo FROM sights s INNER JOIN sight_list sl on s.sight_id = sl.sight_id WHERE sl.tour_id = ?");
        $stmt->execute([$tourId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return ($result) ? $result['photo'] : false;
    }

    /**
     * @param string $type
     * @param string $searchInput
     * @param string $filter
     * @param int $banned
     * @param int $admin
     * @param int $verified
     * @param int $id
     * @return array
     */
    public function searchQuery
    (
        string $type,
        string $searchInput,
        string $filter = '',
        int $banned = 0,
        int $admin = 0,
        int $verified = 0,
        int $id = 0
    ): array
    {
        $query = '';
        $conditions = [];
        $params = [];
        $filter = htmlspecialchars(strip_tags($filter));

        switch ($type) {
            case 'user':
                $query = "SELECT * FROM users f";
                if (!empty($admin)) {
                    $conditions[] = "f.admin = ?";
                    $params[] = 1;
                }
                if (!empty($banned)) {
                    $conditions[] = "f.banned = ?";
                    $params[] = 1;
                }
                $conditions[] = $filter . " LIKE ?";
                $params[] = "%" . $searchInput . "%";
                break;
            case 'city':
                $query = "SELECT * FROM cities f ";
                $conditions[] = "f.city_name LIKE ?";
                $params[] = "%" . $searchInput . "%";
                break;
            case 'category':
                $query = "SELECT * FROM categories f ";
                $conditions[] = "f.category_name LIKE ?";
                $params[] = "%" . $searchInput . "%";
                break;
            case 'sight':
                $template = "SELECT s.sight_id AS sight_id,s.org_id AS org_id, s.sight_name AS sight_name, s.description AS description, 
                                s.photo AS photo, s.category_id AS category_id, s.latitude AS latitude, s.longitude AS longitude, 
                                s.address AS address,s.city_id AS city_id, s.popularity AS popularity FROM sights s ";
                $query = match ($filter)
                {
                    "organisation" => $template . "INNER JOIN organisations o ON s.org_id = o.org_id WHERE o.org_name LIKE ?",
                    "city" => $template . "INNER JOIN cities c ON s.city_id = c.city_id WHERE c.city_name LIKE ?",
                    "category" => $template . "INNER JOIN categories c ON s.category_id = c.category_id WHERE c.category_name LIKE ?",
                    default => "SELECT * FROM sights WHERE " . $filter . " LIKE ?"
                };
                $params[] = "%" . $searchInput . "%";
                break;
            case 'org-sight':
                $query = "SELECT f.* FROM sights f INNER JOIN organisations o ON f.org_id = o.org_id";
                $conditions[] = "f.sight_name LIKE ?";
                $params[] = "%" . $searchInput . "%";
                $conditions[] = "o.org_id = ?";
                $params[] = $id;
                break;
            case 'tour-sight':
                $query = "SELECT * FROM sights f ";
                $conditions[] = "f.org_id = ?";
                $params[] = $filter;
                $conditions[] = "f.sight_name LIKE ?";
                $params[] = "%" . $searchInput . "%";
                break;
            case 'tour':
                $sql = match ($filter)
                {
                    "user" => "SELECT * FROM custom_tours t INNER JOIN users u ON t.user_id = u.user_id WHERE u.username LIKE ? ORDER BY u.username",
                    "country" => "SELECT * FROM custom_tours WHERE country LIKE ? ORDER BY country",
                    default => "SELECT * FROM custom_tours WHERE tour_name LIKE ? ORDER BY tour_name"
                };
                $stmt = $GLOBALS['pdo']->prepare($sql);
                $stmt->execute(["%" . $searchInput . "%"]);
                break;
            case 'favourites':
                $stmt = $GLOBALS['pdo']->prepare(
                    "SELECT * FROM favorites f INNER JOIN sights s ON 
            f.sight_id = s.sight_id AND user_id = ? AND s.sight_name LIKE ?"
                );
                $stmt->execute([$id, "%" . $searchInput . "%"]);
                break;
            case 'archive':
                $stmt = $GLOBALS['pdo']->prepare(
                    "SELECT * FROM custom_tours ct INNER JOIN users u ON ct.user_id = u.user_id 
                        WHERE u.user_id = ? AND ct.tour_name LIKE ? ORDER BY ct.tour_name"
                );
                $stmt->execute([$id, "%" . $searchInput . "%"]);
                break;
            case 'org':
                $query = "SELECT * FROM organisations f";
                $conditions[] = $filter . " LIKE ?";
                $params[] = "%" . $searchInput . "%";
                if (!empty($verified))
                {
                    $conditions[] = " f.verified = ?";
                    $params[] = 1;
                }
                if (!empty($banned))
                {
                    $conditions[] = "f.hidden = ?";
                    $params[] = 1;
                }
                break;
            case 'comment':
                $query = 'SELECT f.*, s.sight_name, u.username FROM comments f 
                            INNER JOIN users u on f.user_id = u.user_id 
                            INNER JOIN sights s on s.sight_id = f.sight_id';
                if(!empty($banned))
                {
                    $conditions[] = "f.hidden = ?";
                    $params[] = 1;
                }
                $conditions[] = match ($filter)
                {
                    default => 's.sight_name LIKE ?',
                    'user' => 'u.username LIKE ?',
                };
                $params[] = "%" . $searchInput . "%";
                break;
        }
        if (!in_array($type, ['tour', 'favourites', 'archive'])) {
            if (!empty($conditions)) {
                $query .= " WHERE " . implode(" AND ", $conditions);
            }
            $stmt = $GLOBALS['pdo']->prepare($query);
            $stmt->execute($params);
        }

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param string $filter
     * @param string $searchInput
     * @param string $category
     * @param string $country
     * @param string $city
     * @param string $org
     * @return array|false
     */
    public function advancedSearch
    (
        string $filter,
        string $searchInput = '',
        string $category = '',
        string $country = '',
        string $city = '',
        string $org = ''
    ): array|false
    {
        $conditions = [];
        $params = [];

        switch ($filter)
        {
            case 'custom_tours':
                $template = "INNER JOIN sight_list sl ON f.tour_id = sl.tour_id INNER JOIN sights s ON sl.sight_id = s.sight_id ";
                $orgSql = "INNER JOIN organisations o ON s.org_id = o.org_id ";
                $citySql = "INNER JOIN cities c ON s.city_id = c.city_id ";
                $catSql = "INNER JOIN categories cat ON s.category_id = cat.category_id ";
                break;
            case 'sights':
                $orgSql = "INNER JOIN organisations o ON f.org_id = o.org_id ";
                $citySql = "INNER JOIN cities c ON f.city_id = c.city_id ";
                $catSql = "INNER JOIN categories cat ON f.category_id = cat.category_id ";
                break;
        }
        $query = match($filter)
        {
            "custom_tours" => "SELECT DISTINCT f.tour_id FROM " . $filter . " f ",
            "sights" => "SELECT DISTINCT f.sight_id FROM " . $filter . " f ",
        };
        if((empty($category) || empty($city) || empty($org)) && $filter === 'custom_tours')
            $query .= $template;
        if (!empty($category))
        {
            $query .= $catSql;
            $conditions[] = "cat.category_name = ? ";
            $params[] = $category;
        }
        if (!empty($city))
        {
            $query .= $citySql;
            $conditions[] = "c.city_name = ? ";
            $params[] = $city;
        }
        if (!empty($country))
        {
            $query .= ($filter === 'custom_tours' || !empty($org)) ? '' : $orgSql;
            $conditions[] = ($filter === 'custom_tours') ? "f.country = ?" : "o.country = ?";
            $params[] = $country;
        }
        if (!empty($org))
        {
            $query .= $orgSql;
            $conditions[] = "o.org_name = ?";
            $params[] = $org;
        }
        if (!empty($searchInput)) {
            $conditions[] = match($filter)
            {
                "custom_tours" => "f.tour_name LIKE ?",
                "sights" => "f.sight_name LIKE ?",
            };
            $params[] = "%" . $searchInput . "%";
        }
        if (!empty($conditions)) {
            $query .= " WHERE " . implode(" AND ", $conditions);
        }

        $stmt = $GLOBALS['pdo']->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @return array
     */
    public function retrieveOrgList(): array
    {
        $stmt = $GLOBALS['pdo']->prepare("SELECT * FROM organisations ORDER BY org_name");
        $stmt->execute();
        $result = [];
        foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $org)
        {
            $result[$org['org_id']] = $org['org_name'];
        }
        return $result;
    }
    public function retrieveCities(): array
    {
        $stmt = $GLOBALS['pdo']->prepare("SELECT * FROM cities ORDER BY city_name");
        $stmt->execute();
        $result = [];
        foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $city)
            $result[$city['city_id']] = $city['city_name'];

        return $result;
    }

    /**
     * @param int $tour_id
     * @return array
     */
    public function retrieveTourDetails(int $tour_id): array{
        $tour_sql = "SELECT t.tour_id AS tour_id, t.tour_name AS tour_name, t.visibility AS visibility, 
                     t.description AS description, t.popularity AS popularity, t.country as country, 
                     u.user_id AS user_id, u.first_name AS first_name, u.last_name AS last_name, 
                     u.email AS email, u.phone AS phone
                    FROM custom_tours t INNER JOIN users u ON t.user_id = u.user_id
                    WHERE t.tour_id = ?";
        $sights_sql =  "SELECT sl.list_id AS list_id, sl.tour_order AS tour_order, sl.visited AS visited,
                        s.sight_id AS sight_id, s.org_id AS org, s.sight_name AS sight_name, 
                        s.description AS sight_desc, s.photo AS photo, s.address AS address, 
                        s.city_id AS city_id, c.city_name AS city_name, s.latitude AS latitude, s.longitude AS longitude
                    FROM sight_list sl INNER JOIN sights s ON s.sight_id = sl.sight_id INNER JOIN cities c ON c.city_id = s.city_id
                    WHERE sl.tour_id = ? ORDER BY tour_order";
        $stmt = $GLOBALS['pdo']->prepare($tour_sql);
        $stmt->execute([$tour_id]);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $arr = [];

        foreach($result as $data){
            foreach ($data as $column => $value)
                $arr[$column] = $value;
        }

        $stmt = $GLOBALS['pdo']->prepare($sights_sql);
        $stmt->execute([$tour_id]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach($result as $data)
            $arr['sights'][$data['tour_order']] = $data;

        return $arr;
    }

    /**
     * @param int $tourId
     * @return array
     */
    public function retrieveTourSights(int $tourId): array
    {
        $stmt = $GLOBALS['pdo']->prepare("SELECT * FROM sights s INNER JOIN sight_list sl ON s.sight_id = sl.sight_id  WHERE sl.tour_id = ?");
        $stmt->execute([$tourId]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return !empty($result) ? $result : [];
    }

    /**
     * @param int $tour_id
     * @param string $tour_name
     * @param string $visibility
     * @param string $description
     * @return bool
     */
    public function updateCustomTour(int $tour_id, string $tour_name, string $visibility, string $description): bool
    {
        $stmt = $GLOBALS['pdo']->prepare("UPDATE custom_tours SET tour_name = ?, visibility = ?, description = ? WHERE tour_id = ?");
        return $stmt->execute([$tour_name, $visibility, $description, $tour_id,]);
    }

    /**
     * @param int $tourID
     * @return bool
     */
    public function isTourPublic(int $tourID): bool
    {
        $stmt = $GLOBALS['pdo']->prepare("SELECT visibility FROM custom_tours WHERE tour_id=?");
        $stmt->execute([$tourID]);
        return $stmt->fetch(PDO::FETCH_ASSOC)['visibility'];
    }

    /**
     * @param int $og_tour_id
     * @param int $user_id
     * @param string $tour_name
     * @param string $visibility
     * @param string $description
     * @param string $country
     * @return int
     */
    public function archiveTour
    (
        int $og_tour_id,
        int $user_id,
        string $tour_name,
        string $visibility,
        string $description,
        string $country
    ): int
    {
        $stmt = $GLOBALS['pdo']->prepare("INSERT INTO custom_tours (user_id, tour_name, visibility, description, country) VALUES (?, ?, ?, ?, ?)");

        if($stmt->execute([$user_id, $tour_name, $visibility, $description, $country]))
        {
            $new_tour_id= $GLOBALS['pdo']->lastInsertID();
            $stmt = $GLOBALS['pdo']->prepare("UPDATE custom_tours SET popularity = popularity + 1 WHERE tour_id = ?");
            $stmt->execute([$og_tour_id]);
            $stmt = $GLOBALS['pdo']->prepare("INSERT INTO sight_list (tour_id, sight_id, tour_order) SELECT ?, sight_id, tour_order FROM sight_list WHERE tour_id = ?");
            $stmt->execute([$new_tour_id, $og_tour_id]);
            return $new_tour_id;
        }

        return 0;
    }

    /**
     * @param int $tourId
     * @return void
     */
    public function clearSightList(int $tourId): void
    {
        $stmt = $GLOBALS['pdo']->prepare("DELETE FROM sight_list WHERE tour_id = ?");
        $stmt->execute([$tourId]);
    }

    /**
     * @param int $user_id
     * @param int $tour_id
     * @return bool
     */
    public function matchUserAndTour(int $user_id, int $tour_id): bool
    {
        $stmt = $GLOBALS['pdo']->prepare("SELECT user_id FROM custom_tours WHERE tour_id = ?");
        $stmt->execute([$tour_id]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if(empty($result)) return false;
        if($result[0]['user_id'] == $user_id) return true;
        else return false;
    }
    public function retrieveSameNameTour(string $name): int
    {
        $stmt = $GLOBALS['pdo'] ->prepare('SELECT * FROM custom_tours WHERE tour_name = ? AND visibility = 1');
        $stmt ->execute([$name]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
       return (!empty($result['user_id'])) ? $result['user_id'] : 0;
    }
}