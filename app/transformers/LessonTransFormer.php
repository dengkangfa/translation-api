<?php

namespace App\Transformers;

class LessonTransFormer extends TransformerAbstract
{

    public function transform($lesson)
    {
        return [
            'title' => $lesson['title'],
            'content' => $lesson['body'],
            'is_free' => (boolean) $lesson['free']
        ];
    }
}