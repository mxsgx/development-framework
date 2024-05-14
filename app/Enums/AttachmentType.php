<?php

namespace App\Enums;

enum AttachmentType: string
{
    case Image = 'image';
    case ImageUrl = 'image-url';
    case Video = 'video';
    case VideoUrl = 'video-url';
}
