<?php
namespace App\Interfaces\Http\Requests\Booking;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Carbon\Carbon;



class StoreReservationRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Allow only authenticated users to create reservations.
       // return $this->user() !== null;

       return true;
    }

    public function rules(): array
    {
        return [
            /*
            'bus_id' => ['nullable', 'integer', 'exists:buses,id'],
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'price' => ['nullable', 'numeric', 'min:0'],
            'seat_number' => ['required', 'numeric', 'min:1'],
            'passenger_name' => ['required', 'numeric', 'min:1'], */
            //'payment_method' => ['nullable', 'string', Rule::in(['cash', 'card', 'online'])],
            //'notes' => ['nullable', 'string', 'max:1000'],
            //'status' => ['nullable', 'string', Rule::in(['pending', 'confirmed', 'cancelled'])],
        ];
    }

    public function messages(): array
    {
        return [
            'room_id.required' => 'The room field is required.',
            'room_id.exists' => 'The selected room does not exist.',
            'start_date.required' => 'Start date is required.',
            'start_date.date' => 'Start date must be a valid date.',
            'start_date.after_or_equal' => 'Start date cannot be in the past.',
            'end_date.required' => 'End date is required.',
            'end_date.date' => 'End date must be a valid date.',
            'end_date.after' => 'End date must be after the start date.',
            'guests.required' => 'Number of guests is required.',
            'guests.integer' => 'Guests must be an integer.',
            'guests.min' => 'There must be at least one guest.',
        ];
    }

    protected function prepareForValidation(): void
    {
        $data = $this->all();

        if (isset($data['currency'])) {
            $data['currency'] = strtoupper((string) $data['currency']);
        }

        if (!empty($data['start_date'])) {
            $data['start_date'] = $this->formatDate($data['start_date']);
        }

        if (!empty($data['end_date'])) {
            $data['end_date'] = $this->formatDate($data['end_date']);
        }

        $this->merge($data);
    }

    private function formatDate($value): ?string
    {
        try {
            return Carbon::parse($value)->toDateString();
        } catch (\Throwable $e) {
            return null;
        }
    }
}