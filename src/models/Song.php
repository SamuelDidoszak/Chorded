<?php

class Song {
    private $id;
    private $artist;
    private $title;
    private $chords;

    public function __construct(int $id, string $artist, string $title) {
        $this->id = $id;
        $this->artist = $artist;
        $this->title = $title;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getArtist(): string
    {
        return $this->artist;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getChords(): string
    {
        return $this->chords;
    }

    public function setChords($chords): Song
    {
        $this->chords = $chords;

        return $this;
    }
}