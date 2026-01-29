<?php
class PageContent {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getPageData($page_name) {
        $contentArray = [];

        $stmt = $this->conn->prepare("SELECT section_key, content FROM page_content WHERE page_name = :page_name");

        $stmt->execute(['page_name' => $page_name]);

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $contentArray[$row['section_key']] = $row['content'];
        }

        return $contentArray;
    }
    public function getTeamMembers() {
    $stmt = $this->conn->prepare("SELECT * FROM team_members ORDER BY id ASC");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
}
?>
