<?php

namespace App\Interfaces\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePosteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        // Adjust authorization logic as needed (policies/permissions).
        return true;
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        // Normalize common inputs
        if ($this->has('status')) {
            $this->merge([
                'status' => strtolower((string) $this->input('status')),
            ]);
        }

        if ($this->has('title') && ! $this->has('slug')) {
            // optional: create a simple slug candidate if none provided
            $this->merge([
                'slug' => \Str::slug($this->input('title')),
            ]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string,mixed>
     */
    public function rules(): array
    {
        return [
            // Basic attributes
            'title'        => ['required', 'string', 'max:255'],
            'slug'         => ['nullable', 'string', 'max:255', Rule::unique('posts', 'slug')],
            'content'      => ['required', 'string'],
            // 'excerpt'      => ['nullable', 'string', 'max:500'],

            // Status and dates
            'status'       => ['nullable', 'string', Rule::in(['draft', 'published', 'archived'])],
            'published_at' => ['nullable', 'date', 'date_format:Y-m-d H:i:s'],

            // Relations
            'author_id'    => ['nullable', 'integer', 'exists:users,id'],
            'categories'   => ['nullable', 'array'],
            'categories.*' => ['integer', 'exists:categories,id'],
            'tags'         => ['nullable', 'array'],
            'tags.*'       => ['integer', 'exists:tags,id'],

            // Files / attachments (example)
            'featured_image' => ['nullable', 'file', 'image', 'max:5120'], // max 5MB
        ];
    }

    /**
     * Custom messages for validation errors.
     *
     * @return array<string,string>
     */
    public function messages(): array
    {
        return [
            'title.required'   => 'A title is required.',
            'title.max'        => 'Title may not be greater than :max characters.',
            'slug.unique'      => 'This slug is already in use.',
            'content.required' => 'Content is required.',
            'status.in'        => 'Invalid status value.',
            'published_at.date_format' => 'published_at must match format Y-m-d H:i:s.',
            'author_id.exists' => 'Selected author does not exist.',
            'categories.*.exists' => 'One or more selected categories do not exist.',
            'tags.*.exists'    => 'One or more selected tags do not exist.',
            'featured_image.image' => 'Featured image must be an image file.',
        ];
    }
}