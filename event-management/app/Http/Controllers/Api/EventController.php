<?php

namespace App\Http\Controllers\Api;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class EventController extends Controller
{

    protected function errorResponse(string $message, int $statusCode)
    {
        return new JsonResponse(
            [
                'error' => [
                    'message' => $message,
                    'status' => $statusCode,
                ],
            ],
            $statusCode
        );
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Event::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'start_time' => 'sometimes|date',
            'end_time' => 'sometimes|date|after:start_time',
        ]);
        $event = Event::create([
            ...$data,
            'user_id' => 1
        ]);
        return $event;
    }

    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //     try {
    //         $event = Event::findOrFail($id);
    //         return new JsonResponse($event, Response::HTTP_OK);
    //     } catch (ModelNotFoundException $e) {
    //         // \Log::error($e->getMessage());
    //         return response()->json(array('error' => 'Event not found'),  Response::HTTP_NOT_FOUND);
    //     }
    // }

    public function show(string $id)
    {
        try {
            $event = Event::findOrFail($id);

            // Data to be returned for success
            $data = [
                'message' => 'Event retrieved successfully.',
                'data' => $event,
                'status' => Response::HTTP_OK,
            ];

            // Return a JSON response with the data, message, and a 200 status code (OK)
            return new JsonResponse($data, Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            // If the event is not found, return a JSON response with the "error" key and the error data
            return $this->errorResponse('Event not found.', Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
        ]);
        $event->update([
            ...$data,
            'user_id' => 1
        ]);
        return $event;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();

        return response(status: 204);
    }
}
