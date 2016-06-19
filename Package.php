<?php

namespace SixBySix\Freeagent;

use Doctrine\Common\Annotations;

class Package
{
    public static function registerAnnotations($root = __DIR__)
    {
        Annotations\AnnotationRegistry::registerFile(
            $root . '/vendor/jms/serializer/src/JMS/Serializer/Annotation/Type.php'
        );

        Annotations\AnnotationRegistry::registerFile(
            $root . '/vendor/jms/serializer/src/JMS/Serializer/Annotation/Accessor.php'
        );

        Annotations\AnnotationRegistry::registerFile(
            $root . '/vendor/jms/serializer/src/JMS/Serializer/Annotation/Groups.php'
        );

        Annotations\AnnotationRegistry::registerFile(
            $root . '/vendor/jms/serializer/src/JMS/Serializer/Annotation/Expose.php'
        );

        Annotations\AnnotationRegistry::registerFile(
            $root . '/vendor/jms/serializer/src/JMS/Serializer/Annotation/Exclude.php'
        );

        Annotations\AnnotationRegistry::registerFile(
            $root . '/vendor/jms/serializer/src/JMS/Serializer/Annotation/HandlerCallback.php'
        );

        Annotations\AnnotationRegistry::registerFile(
            $root . '/vendor/jms/serializer/src/JMS/Serializer/Annotation/PostDeserialize.php'
        );

        Annotations\AnnotationRegistry::registerFile(
            $root . '/vendor/jms/serializer/src/JMS/Serializer/Annotation/SerializedName.php'
        );
    }
}