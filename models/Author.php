<?php	
	class Authors{
		private $conn;
		private $table = 'authors';
		
		public $id;
		public $author;
		
		public function __construct($db) {
			$this->conn = $db;
		}
		
		// Read all authors
		
		public function display_authors() {
			$query = 'SELECT
				id,
				author
			FROM
				' . $this->table . '
			ORDER BY
				id';
				
			$stmt = $this->conn->prepare($query);
			$stmt->execute();
			return $stmt;
		}
		
		// Read single author
		
		public function read_single() {
			$query = 'SELECT
				id,
				author
			FROM
				' . $this->table . '
			WHERE
				id = :id
			LIMIT 1';
			
			$stmt = $this->conn->prepare($query);
			$stmt->bindParam(':id', $this->id);
			$stmt->execute();
			
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			
			if (is_array($row)) {
				$this->id = $row['id'];
				$this->author = $row['author'];
			}
		}
		
		// Create author
		
		public function create() {
			$query = 'INSERT INTO ' .
				$this->table . '(author)
			VALUES(
				 :author)';
				
			$stmt = $this->conn->prepare($query);
			$this->author = htmlspecialchars(strip_tags($this->author));
			$stmt->bindParam(':author', $this->author);
			
			if ($stmt->execute()) {
				return true;
			}
			
			printf("Error: %s.\n", $stmt->error);
			return false;
		}
		
		// Update author
		
		public function update() {
			$query = 'UPDATE ' .
				$this->table . '
			SET
				author = :author
			WHERE
				id = :id';
				
			$stmt = $this->conn->prepare($query);
			$this->author = htmlspecialchars(strip_tags($this->author));
			$this->id = htmlspecialchars(strip_tags($this->id));
			$stmt->bindParam(':author', $this->author);
			$stmt->bindParam(':id', $this->id);
			
			if ($stmt->execute()) {
				return true;
			}
			
			printf("Error: %s.\n", $stmt->error);
			return false;
			
			echo $query;
		}
		
		// Delete author
		
		public function delete() {
			$query = 'DELETE FROM ' .
				$this->table .
			' WHERE id = :id';
			
			$stmt = $this->conn->prepare($query);
			
			$this->id = htmlspecialchars(strip_tags($this->id));
			
			$stmt->bindParam(':id', $this->id);
			
			if ($stmt->execute()) {
				return true;
			}
			
			printf("Error: %s.\n", $stmt->error);
			return false;
		}
	}
?>