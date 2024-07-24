<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use OpenApi\Annotations as OA;
/**
 * @OA\Info(
 *      version="3.0",
 *      title="Api documentation",
 *      description="Api documentation",
 *      @OA\Contact(
 *          email="support@example.com"
 *      )
 * )
 *
 * @OA\Response(
 *     response="404",
 *     description="Not Found",
 * )
 *
 * * @OA\Tag(
 *     name="Guests",
 *     description="Methods of guests"
 * )
 *
 * @OA\Response(
 *      response="422",
 *      description="Unprocessable Content",
 *      @OA\JsonContent(
 *          @OA\Property (property="message", type="string", example="The given data was invalid."),
 *          @OA\Property (property="errors", type="object", description="array of validation errors",
 *              @OA\Property (property="field", type="array", @OA\Items(type="string", example="description of error"))
 *          )
 *      )
 *  )
 *
 *
 */
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
