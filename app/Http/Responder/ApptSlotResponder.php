<?php

namespace App\Http\Responder;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use RsvForm\Domain\Models\ApptSlot\ApptSlot;
use RsvForm\Presentation\ApptSlotJsonSerializer;

class ApptSlotResponder
{
    /**
     * @var ApptSlotJsonSerializer
     */
    private $serializer;

    /**
     * @param ApptSlotJsonSerializer $serializer
     */
    public function __construct(ApptSlotJsonSerializer $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * エンティティでレスポンス
     * @param ApptSlot $apptSlot
     * @param int $status
     * @return JsonResponse
     */
    public function withEntity(ApptSlot $apptSlot, $status = Response::HTTP_OK): JsonResponse
    {
        return new JsonResponse(
            [
                'apptSlot' => $this->serializer->serialize($apptSlot)
            ],
            $status
        );
    }

    /**
     * エンティティのコレクションでレスポンス
     * @param Collection|ApptSlot[] $apptSlots
     * @param int $status
     * @return JsonResponse
     */
    public function withEntityCollection($apptSlots, $status = Response::HTTP_OK): JsonResponse
    {
        return new JsonResponse(
            [
                'apptSlots' => $this->serializer->serializeCollection($apptSlots)
            ],
            $status
        );
    }

    /**
     * エラーのレスポンス
     * @param Exception $e
     * @param int $status
     * @return JsonResponse
     */
    public function error(Exception $e, $status = Response::HTTP_INTERNAL_SERVER_ERROR): JsonResponse
    {
        return new JsonResponse(
            [
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
            ],
            $status
        );
    }
}
