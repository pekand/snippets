<?php

/*
	Closures and First-Class Callables in Constant Expressions
	Static closures and first-class callables can now be used in constant expressions. 
	This includes attribute parameters, default values of properties and parameters, and constants.
*/

// PHP 8.5
#[Attribute(Attribute::TARGET_METHOD)]
class AccessControl
{
    public function __construct(
        public Closure $check
    ) {}
}

class Request
{
    public mixed $user;

    public function __construct(
        mixed $user = null
    ) {
        $this->user = $user;
    }
}

class Post
{
    public mixed $author;

    public function __construct(mixed $author = null)
    {
        $this->author = $author;
    }

    public function getAuthor(): mixed
    {
        return $this->author;
    }
}

class Response
{
}

function callControllerMethod(object $controller, string $method, Request $request, Post $post)
{
    $ref = new ReflectionMethod($controller, $method);

    foreach ($ref->getAttributes(AccessControl::class) as $attr) {
        $instance = $attr->newInstance();

        $ok = ($instance->check)($request, $post);

        echo "AccessControl returned: ";
        var_dump($ok);

        if (!$ok) {
            echo "Access denied.\n";
            return;
        }
    }

    echo "Access granted.\n";

    $controller->$method($request, $post);
}

final class PostsController1
{
    #[AccessControl(static function (
        Request $request,
        Post $post,
    ): bool {
        return $request->user === $post->getAuthor();
    })]
    public function update(
        Request $request,
        Post $post,
    ): Response {
        return new Response();
    }
}

$request = new Request();
$request->user = 123;

$post = new Post();
$post->author = 123;

$controller = new PostsController1();

callControllerMethod($controller, 'update', $request, $post); // Access granted

$post = new Post();
$post->author = 999; 

callControllerMethod($controller, 'update', $request, $post); // Access denied.

// PHP 8.4

final class PostsController2
{
    #[AccessControl(
        new Expression('request.user === post.getAuthor()'),
    )]
    public function update(
        Request $request,
        Post $post,
    ): Response {
        // ...
    }
}
