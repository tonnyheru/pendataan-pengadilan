<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    public $status;
    public $message;
    public $resource;

    public function __construct($status, $message, $resource)
    {
        $this->status = $status;
        $this->message = $message;
        $this->resource = $this->cleanHiddenFields($resource);
    }
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // Bersihkan semua uid dan submission_uid dari resource
        return [
            'status' => $this->status,
            'message' => $this->message,
            'data' => $this->resource,
        ];
    }


    private function cleanHiddenFields($data)
    {
        $hidden = ['uid', 'submission_uid'];

        // if ($data instanceof \Illuminate\Pagination\AbstractPaginator) {
        //     return [
        //         'current_page' => $data->currentPage(),
        //         'data' => collect($data->items())->map(fn($item) => $this->cleanHiddenFields($item))->values(),
        //         'first_page_url' => $data->url(1),
        //         'from' => $data->firstItem(),
        //         'last_page' => $data->lastPage(),
        //         'last_page_url' => $data->url($data->lastPage()),
        //         'links' => $data->linkCollection(),
        //         'next_page_url' => $data->nextPageUrl(),
        //         'path' => $data->path(),
        //         'per_page' => $data->perPage(),
        //         'prev_page_url' => $data->previousPageUrl(),
        //         'to' => $data->lastItem(),
        //         'total' => $data->total(),
        //     ];
        // }

        if (is_array($data)) {
            return collect($data)->except($hidden)->map(function ($value) {
                return $this->cleanHiddenFields($value);
            })->all();
        }

        if (is_object($data)) {
            $array = method_exists($data, 'toArray') ? $data->toArray() : (array) $data;

            return collect($array)->except($hidden)->map(function ($value) {
                return $this->cleanHiddenFields($value);
            })->all();
        }

        return $data;
    }
}
