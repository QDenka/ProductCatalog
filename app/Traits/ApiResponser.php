<?php

namespace App\Traits;

trait ApiResponser
{
	/**
     * Return a success JSON response.
     *
     * @param  array|string  $data
     * @param  int|null  $code
     * @return \Illuminate\Http\JsonResponse
     */
	protected function success($data, int $code = 200)
	{
		return response()->json([
			'status' => 'success',
			'data' => $data
		], $code);
	}

	/**
     * Return an error JSON response.
     *
     * @param  string  $message
     * @param  int  $code
     * @param  array|string|null  $data
     * @return \Illuminate\Http\JsonResponse
     */
	protected function error(string $message = null, int $code, $data = null)
	{
		return response()->json([
			'status' => 'error',
			'message' => $message,
			'data' => $data
		], $code);
	}

}