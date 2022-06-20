<?php

require_once "Repository.php";
require_once __DIR__."/../models/Song.php";

class SongRepository extends Repository {
    private $song;

    public function addGetSong(string $artist, string $title): ?Song {
        $query = $this->database->connect()->prepare(
            "SELECT add_song('$artist', '$title');"
        );
        $query->bindParam(":artist", $artist, ":title", $title, PDO::PARAM_STR);
        $query->execute();

        $song = $query->fetch(PDO::FETCH_ASSOC);
        if($song == false)
            return null;
        $this->song = new Song(
            $song["add_song"],
            $artist,
            $title
        );
        return $this->song;
    }
    
    public function addSongToHistory(int $user_id) {
        if($this->song->getId() == null)
            return;
        $song_id = $this->song->getId();
        $query = $this->database->connect()->prepare(
            "INSERT INTO history(user_id, song_id) VALUES ($user_id, $song_id)"
        );
        $query->bindParam(":user_id", $user_id, ":song_id", $this->song->getId(), PDO::PARAM_INT);
        $query->execute();
    }
}

