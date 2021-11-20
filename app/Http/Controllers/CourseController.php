<?php

namespace App\Http\Controllers;

use App\Http\Responder\CourseResponder;
use Illuminate\Http\JsonResponse;
use RsvForm\Usecase\Management\CourseIndex;

class CourseController
{
    /**
     * @var CourseResponder
     */
    private $responder;

    /**
     * コンストラクタ
     * @param CourseResponder $responder
     */
    public function __construct(CourseResponder $responder)
    {
        $this->responder = $responder;
    }

    /**
     * コース一覧の取得
     * @param CourseIndex $usecase
     * @return JsonResponse
     */
    public function index(CourseIndex $usecase): JsonResponse
    {
        $courses = $usecase->__invoke();
        return $this->responder->withEntityCollection($courses);
    }

    /**
     * 特定コースの取得
     * @param int $id
     * @param ShowTodoItem $usecase
     * @return JsonResponse
     */
    // public function show(int $id, CourseShow $usecase): JsonResponse
    // {
    //     try {
    //         $todoItem = $usecase->__invoke(TodoItemId::of($id));
    //     } catch (EntityNotFoundException $e) {
    //         return $this->responder->error($e, Response::HTTP_NOT_FOUND);
    //     }

    //     return $this->responder->withEntity($todoItem);
    // }

    // public function add(AddTodoItemRequest $request, AddTodoItem $usecase): JsonResponse
    // {
    //     $inputs = $request->only(['title']);

    //     try {
    //         $todoItem = $usecase->__invoke($inputs);
    //     } catch (PersistenceException $e) {
    //         logs()->error($e);
    //         return $this->responder->error($e);
    //     }

    //     return $this->responder->withEntity($todoItem, Response::HTTP_CREATED);
    // }

    // public function complete(int $id, CompleteTodoItem $usecase): JsonResponse
    // {
    //     try {
    //         $todoItem = $usecase->__invoke(TodoItemId::of($id));
    //     } catch (EntityNotFoundException $e) {
    //         logs()->error($e);
    //         return $this->responder->error($e, Response::HTTP_NOT_FOUND);
    //     } catch (PersistenceException $e) {
    //         logs()->error($e);
    //         return $this->responder->error($e);
    //     }

    //     return $this->responder->withEntity($todoItem);
    // }
}
