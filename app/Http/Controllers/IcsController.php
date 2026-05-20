<?php

namespace App\Http\Controllers;

use App\Http\Requests\IcsRequest;
use App\Services\CalendarEventNormalizer;
use App\Services\IcsGenerator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class IcsController extends Controller
{
    public function create(IcsRequest $request, CalendarEventNormalizer $normalizer, IcsGenerator $generator): Response
    {
        $generated = $generator->generate(
            $normalizer->normalize($request->validated()),
        );

        return $this->calendarResponse($generated);
    }

    public function store(IcsRequest $request, CalendarEventNormalizer $normalizer, IcsGenerator $generator): Response|JsonResponse
    {
        $generated = $generator->generate(
            $normalizer->normalize($request->validated()),
        );

        if ($request->wantsJson()) {
            return response()->json($generated);
        }

        return $this->calendarResponse($generated);
    }

    /**
     * @param  array{filename: string, mime_type: string, content: string}  $generated
     */
    protected function calendarResponse(array $generated): Response
    {
        return response($generated['content'], 200, [
            'Content-Type' => $generated['mime_type'],
            'Content-Disposition' => 'attachment; filename="'.$generated['filename'].'"',
        ]);
    }
}
