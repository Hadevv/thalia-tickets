<?php

namespace App\Traits;

trait ApiResponseTrait
{
    /**
     * Envoyer une réponse de succès
     *
     * @param mixed $data
     * @param string|null $message
     * @param int $status
     * @param array $headers
     * @return \Illuminate\Http\JsonResponse
     */
    public function successResponse($data, ?string $message = null, int $status = 200, array $headers = []): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => $message,
        ], $status, $headers);
    }

    /**
     * Envoyer une réponse d'erreur
     *
     * @param string|null $message
     * @param int $status
     * @param array $headers
     * @return \Illuminate\Http\JsonResponse
     */
    public function errorResponse(?string $message = null, int $status = 404, array $headers = []): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message,
        ], $status, $headers);
    }

    /**
     * Envoyer une not found erreur
     *
     * @param string|null $message
     * @param array $headers
     * @return \Illuminate\Http\JsonResponse
     */
    public function notFoundResponse(?string $message = 'Not found', array $headers = []): JsonResponse
    {
        return $this->errorResponse($message, 404, $headers);
    }

    /**
     * Envoyer une server erreur
     *
     * @param string|null $message
     * @param array $headers
     * @return \Illuminate\Http\JsonResponse
     */
    public function serverErrorResponse(?string $message = 'Server error', array $headers = []): JsonResponse
    {
        return $this->errorResponse($message, 500, $headers);
    }
}
