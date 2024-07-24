<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGuestRequest;
use App\Http\Requests\UpdateGuestRequest;
use App\Http\Resources\GuestResource;
use App\Models\Guest;
use App\Models\User;
use App\Service\PhoneCountryService;
use Illuminate\Http\Request;
use libphonenumber\geocoding\PhoneNumberOfflineGeocoder;
use libphonenumber\PhoneNumberUtil;
use Propaganistas\LaravelPhone\PhoneNumber;
use OpenApi\Annotations as OA;

class GuestController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/guests",
     *     summary="Method for checking list of guests",
     *     tags={"Guests"},
     *     @OA\Response(
     *         response="200",
     *         description="Get list of guests",
     *         @OA\JsonContent(
     *              @OA\Property (property="data", type="array",
     *                   @OA\Items(
     *                       type="object",
     *
     *                           @OA\Property (property="id", type="integer", example="1"),
     *                           @OA\Property (property="firstname", type="string", example="Alexey"),
     *                           @OA\Property (property="lastname", type="string", example="Dmitriev"),
     *                           @OA\Property (property="phone", type="string", example="79999999999"),
     *                           @OA\Property (property="email", type="string", example="alexey.dmitriev.2000@gmail.com"),
     *                           @OA\Property (property="country", type="string", example="Russia"),
     *                           @OA\Property (property="created_at", type="string", format="date-time", example="2024-07-24T15:56:56.000000Z"),
     *                           @OA\Property (property="updated_at", type="string", format="date-time", example="2024-07-24T15:56:56.000000Z")
     *
     *                   )
     *               )
     *         )
     *     )
     * )
     */
    public function index()
    {
        return GuestResource::collection(Guest::all());
    }

    /**
     * @OA\Post(
     *     path="/api/guests",
     *     summary="Method for creating info about guest",
     *     tags={"Guests"},
     *     @OA\Response(
     *         response="201",
     *         description="Creating info about guest",
     *         @OA\JsonContent(
     *              @OA\Property (property="data", type="object", description="info about created guest",
     *                      @OA\Property (property="id", type="integer", example="1"),
     *                      @OA\Property (property="firstname", type="string", example="Alexey"),
     *                      @OA\Property (property="lastname", type="string", example="Dmitriev"),
     *                      @OA\Property (property="phone", type="string", example="79999999999"),
     *                      @OA\Property (property="email", type="string", example="alexey.dmitriev.2000@gmail.com"),
     *                      @OA\Property (property="country", type="string", example="Russia"),
     *                      @OA\Property (property="created_at", type="string", format="date-time", example="2024-07-24T15:56:56.000000Z"),
     *                      @OA\Property (property="updated_at", type="string", format="date-time", example="2024-07-24T15:56:56.000000Z")
     *              )
     *         )
     *     ),
     *     @OA\Response(response="404", ref="#/components/responses/404"),
     *     @OA\Response(response="422", ref="#/components/responses/422")
     * )
     */
    public function create(StoreGuestRequest $request)
    {
        $guestData = $request->validated();

        $geoCoder = PhoneCountryService::getInstance();
        $util = PhoneNumberUtil::getInstance();
        $numberProto = $util->parse('+'.$guestData['phone'], '');

        $guestData['country'] = $guestData['country'] ?? $geoCoder->getCountryByNumber($numberProto, 'En');

        return new GuestResource(Guest::create($guestData));
    }

    /**
     * @OA\Get(
     *     path="/api/guests/{id}",
     *     summary="Method for checking info about guest",
     *     tags={"Guests"},
     *     @OA\Response(
     *         response="200",
     *         description="Get info about guest",
     *         @OA\JsonContent(
     *              @OA\Property (property="data", type="object", description="info about guest",
     *                      @OA\Property (property="id", type="integer", example="1"),
     *                      @OA\Property (property="firstname", type="string", example="Alexey"),
     *                      @OA\Property (property="lastname", type="string", example="Dmitriev"),
     *                      @OA\Property (property="phone", type="string", example="79999999999"),
     *                      @OA\Property (property="email", type="string", example="alexey.dmitriev.2000@gmail.com"),
     *                      @OA\Property (property="country", type="string", example="Russia"),
     *                      @OA\Property (property="created_at", type="string", format="date-time", example="2024-07-24T15:56:56.000000Z"),
     *                      @OA\Property (property="updated_at", type="string", format="date-time", example="2024-07-24T15:56:56.000000Z")
     *              )
     *         )
     *     ),
     *     @OA\Response(response="404", ref="#/components/responses/404"),
     * )
     */
    public function show(string $id)
    {
        $guest = Guest::find($id);

        if (!$guest) abort(404);

        return new GuestResource($guest);
    }

    /**
     * @OA\Patch(
     *     path="/api/guests/{id}",
     *     summary="Method for updating info about guest",
     *     tags={"Guests"},
     *     @OA\Response(
     *         response="200",
     *         description="Update info about guest",
     *         @OA\JsonContent(
     *              @OA\Property (property="data", type="object", description="info about updated guest",
     *                      @OA\Property (property="id", type="integer", example="1"),
     *                      @OA\Property (property="firstname", type="string", example="Alexey"),
     *                      @OA\Property (property="lastname", type="string", example="Dmitriev"),
     *                      @OA\Property (property="phone", type="string", example="79999999999"),
     *                      @OA\Property (property="email", type="string", example="alexey.dmitriev.2000@gmail.com"),
     *                      @OA\Property (property="country", type="string", example="Russia"),
     *                      @OA\Property (property="created_at", type="string", format="date-time", example="2024-07-24T15:56:56.000000Z"),
     *                      @OA\Property (property="updated_at", type="string", format="date-time", example="2024-07-24T15:56:56.000000Z")
     *              )
     *         )
     *     ),
     *     @OA\Response(response="404", ref="#/components/responses/404"),
     *     @OA\Response(response="422", ref="#/components/responses/422")
     * )
     */
    public function update(UpdateGuestRequest $request, string $id)
    {
        $guestData = $request->validated();
        $guest = Guest::find($id);
        if (!$guest) abort(404);

        $guest->update($guestData);

        return new GuestResource($guest);
    }

    /**
     * @OA\Delete(
     *     path="/api/guests/{id}",
     *     summary="Method for deleting info about guest",
     *     tags={"Guests"},
     *     @OA\Response(
     *         response="204",
     *         description="No content(Info about guest was deleted)"
     *     ),
     *     @OA\Response(response="404", ref="#/components/responses/404")
     * )
     */
    public function destroy(string $id)
    {
        $guest = Guest::find($id);

        if (!$guest) abort(404);

        $guest->delete();

        return response()->noContent();
    }
}
