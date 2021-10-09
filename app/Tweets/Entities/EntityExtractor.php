<?php

namespace App\Tweets\Entities;

use App\Tweets\Entities\EntityType;

class EntityExtractor 
{

    /**
     * Undocumented variable
     *
     * @var [type]
     */
    protected $string;

    /**
     * 
     */
    const HASHTAG_REGEX = '/(?!\s)#([A-Za-z]\w*)\b/';
    const MENTION_REGEX = '/(?=[^\w!])@(\w+)\b/';

    /**
     * Undocumented function
     *
     * @param [type] $string
     */
    public function __construct($string)
    {
        $this->string = $string;
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function getHashTagEntities ()
    {
        return $this->buildEntityCollection(
            $this->pattern(self::HASHTAG_REGEX),
            EntityType::HASHTAG
        );
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function getMentionEntities ()
    {
        return $this->buildEntityCollection(
            $this->pattern(self::MENTION_REGEX),
            EntityType::MENTION
        );
    }

    public function getAllEntities ()
    {
       return array_merge( $this->getHashTagEntities(), $this->getMentionEntities() );
    }

    public function buildEntityCollection ($entities, $type)
    {
        return array_map(function ($entity, $index) use( $entities, $type ) {
            return [
                'body' => $body = $entity[0],
                'body_plain' => $entities[1][$index][0],
                'type' => $type,
                'start' => $start = $entity[1],
                'end' => $start + strlen($body)
            ];
        }, $entities[ 0 ], array_keys( $entities[ 0 ] ) );
    }

    public function pattern ($regex)
    {
        preg_match_all( $regex, $this->string, $matches, PREG_OFFSET_CAPTURE );

        return $matches;
    }
}