<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GameRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->route('game') ?: null;

        return [
            'date' => 'required|date_format:d/m/Y',
            'game_start' => 'required|date_format:H:i:s',
            'game_end' => 'required|date_format:H:i:s',
            'house_team_id' => 'required|exists:teams,id',
            'guest_team_id' => 'required|exists:teams,id',
            'score_house_team' => 'required|integer',
            'score_guest_team' => 'required|integer',
        ];
    }
}
