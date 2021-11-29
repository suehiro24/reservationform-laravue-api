<?php

namespace App\Http\Controllers;

use App\Http\Responder\ApptSlotResponder;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use RsvForm\Domain\Models\ApptSlot\ApptSlot;
use RsvForm\Usecase\Management\ApptSlotCreate;
use RsvForm\Usecase\Management\ApptSlotIndex;
use RsvForm\Usecase\Management\ApptSlotUpdate;

class ApptSlotController
{
    /**
     * @var ApptSlotResponder
     */
    private $responder;

    /**
     * コンストラクタ
     * @param ApptSlotResponder $responder
     */
    public function __construct(ApptSlotResponder $responder)
    {
        $this->responder = $responder;
    }

    /**
     * 予約枠一覧の取得
     * @param ApptSlotIndex $usecase
     * @return JsonResponse
     */
    public function index(ApptSlotIndex $usecase): JsonResponse
    {
        try {
            $apptSlots = $usecase->__invoke();
        } catch (Exception $e) {
            logs()->error($e);
            return $this->responder->error($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return $this->responder->withEntityCollection($apptSlots);
    }

    /**
     * 予約枠の新規作成
     * @param Request $request
     * @param ApptSlotCreate $usecase
     * @return JsonResponse
     */
    public function new(Request $request, ApptSlotCreate $usecase): JsonResponse
    {
        $posts = $request->input();

        try {
            $apptSlot = $usecase->__invoke($posts);
        } catch (Exception $e) {
            logs()->error($e);
            return $this->responder->error($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $this->responder->withEntity($apptSlot, Response::HTTP_CREATED);
    }

    public function update(Request $request, ApptSlotUpdate $usecase): JsonResponse
    {
        $posts = $request->input();

        try {
            $apptSlot = $usecase->__invoke($posts);
        } catch (Exception $e) {
            logs()->error($e);
            return $this->responder->error($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $this->responder->withEntity($apptSlot, Response::HTTP_OK);
    }

    // public function delete(Request $request, CourseDelete $usecase): JsonResponse
    // {
    //     $posts = $request->input();

    //     try {
    //         $isDeleted = $usecase->__invoke($posts);
    //         if (! $isDeleted) {
    //             throw new Exception();
    //         }
    //     } catch (Exception $e) {
    //         logs()->error($e);
    //         return $this->responder->error($e, Response::HTTP_INTERNAL_SERVER_ERROR);
    //     }

    //     return new JsonResponse(
    //         [],
    //         Response::HTTP_OK
    //     );
    // }
}
