<?php
class User {
    // database connection and table name
    private $conn;
    private $table_name = "users";
 
    // object properties
    public $id;
    public $user_role_id;
    public $username;
    public $password;
    public $created;
 
    /**
     * Constructor to initialize the object.
     * 
     * @param PDO $db database with the connection
     */
    public function __construct(PDO $db){
        $this->conn = $db;

        // default values
        $this->user_role_id = 1;
        $this->create = date('Y-m-d H:i:s');
    }

    private function sanitize() {
        $this->id = (int) htmlspecialchars(strip_tags($this->id));
        $this->user_role_id = (int) htmlspecialchars(strip_tags($this->user_role_id));
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->password = strip_tags($this->password);
        $this->created = htmlspecialchars(strip_tags($this->created));
    }

    /**
     * Reads users from the MySQL Database.
     * 
     * @return PDOStatement with the executed query
     */
    public function read() {
        // select all query
        $query = "SELECT `id`, `username`, `user_role_id`, `created`
        FROM ".$this->table_name;

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    function read_one() {
        // query to read single record
        $query = "SELECT `id`, `user_role_id`, `username`, `created`
        FROM ". $this->table_name."
        WHERE `id` = :id
        LIMIT 0,1";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // bind id of product to be updated
        $stmt->bindParam("id", $this->id);

        // execute query
        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values to object properties
        $this->id = $row['id'];
        $this->username = $row['username'];
        $this->user_role_id = $row['user_role_id'];
        $this->created = $row['created'];
    }

    /**
     * Creates a new database entry with the current set values.
     * Values will be stripped and sanitized.
     */
    function create() {
        // query to insert record
        $query = "INSERT INTO ".$this->table_name."
                (`user_role_id`, `username`, `password`, `created`)
                VALUES (:user_role_id, :username, :password, :created)";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->sanitize();

        //TODO validate values
    
        // bind values
        $stmt->bindParam(":user_role_id", $this->user_role_id);
        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":created", $this->created);
    
        //TODO return message etc.
        // execute query
        return $stmt->execute();
    }
    
    function update(){
        // update query
        $query = "UPDATE ".$this->table_name."
                SET
                    id = :id,
                    user_role_id = :user_role_id
                    username = :username,
                    password = :password
                WHERE
                    id = :id";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->sanitize();
    
        // bind new values
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(":user_role_id", $this->user_role_id);
        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":password", $this->password);
    
        // execute the query
        return $stmt->execute();
    }
}
?>