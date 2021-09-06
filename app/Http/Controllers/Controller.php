<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *      title="Laravel Github User API",
 *      description="Powered by: Laravel v8, PHP v7.3, Nginx, Ubuntu 18.04, AWS Elasticache (Redis), AWS RDS (MySQL), Github User API",
 *      version="1.0.0",
 * )
 * @OA\Server(
 *      url=L5_SWAGGER_CONST_HOST,
 *      description="API Server"
 *  )
 * @OA\SecurityScheme(
 *      securityScheme="bearerAuth",
 *      in="header",
 *      name="bearerAuth",
 *      type="http",
 *      scheme="bearer",
 *      bearerFormat="JWT",
 * ),
* @OA\Get(
 *      path="/api",
 *      tags={"Test"},
 *      summary="Display welcome message",
 *      @OA\Response(
 *          response=200,
 *          description="Successful operation",
 *      ),
 *      @OA\Response(
 *          response=500,
 *          description="Server error",
 *      ),
 * )
 * @OA\Post(
 *      path="/api/register",
 *      tags={"Auth"},
 *      summary="Register for a user account",
 *      @OA\RequestBody(
 *          required=true,
 *          @OA\JsonContent(
 *              @OA\Property(property="name", type="string", example="Test"),
 *              @OA\Property(property="email", type="string", format="email", example="test@gmail.com"),
 *              @OA\Property(property="password", type="string", format="password", example="test"),
 *              @OA\Property(property="password_confirmation", type="string", format="password", example="test"),
 *          ),
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Successful operation",
 *      ),
 *      @OA\Response(
 *          response=401,
 *          description="Unauthenticated",
 *      ),
 *      @OA\Response(
 *          response=500,
 *          description="Server error",
 *      ),
 * )
 * @OA\Post(
 *      path="/api/login",
 *      tags={"Auth"},
 *      summary="Login user",
 *      @OA\RequestBody(
 *          required=true,
 *          @OA\JsonContent(
 *              @OA\Property(property="email", type="string", format="email", example="test@gmail.com"),
 *              @OA\Property(property="password", type="string", format="password", example="test"),
 *          ),
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Successful operation",
 *      ),
 *      @OA\Response(
 *          response=401,
 *          description="Unauthenticated",
 *      ),
 *      @OA\Response(
 *          response=500,
 *          description="Server error",
 *      ),
 * )
 * @OA\Post(
 *      path="/api/logout",
 *      tags={"Auth"},
 *      summary="Logout user",
 *      security={{ "bearerAuth": {} }},
 *      @OA\Response(
 *          response=200,
 *          description="Successful operation",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="Logged out"),
 *          )
 *      ),
 *      @OA\Response(
 *          response=401,
 *          description="Unauthenticated",
 *      ),
 *      @OA\Response(
 *          response=500,
 *          description="Server error",
 *      ),
 * )
 * @OA\Post(
 *      path="/api/github",
 *      tags={"Github"},
 *      summary="Get github user info",
 *      security={{ "bearerAuth": {} }},
 *      @OA\RequestBody(
 *          required=true,
 *          @OA\JsonContent(
 *              @OA\Property(
 *                  property="usernames",
 *                  type="string",
 *                  example={"jason", "mojombo"},
 *              ),
 *          ),
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Successful operation",
 *      ),
 *      @OA\Response(
 *          response=401,
 *          description="Unauthenticated",
 *      ),
 *      @OA\Response(
 *          response=500,
 *          description="Server error",
 *      ),
 * )
 **/

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
