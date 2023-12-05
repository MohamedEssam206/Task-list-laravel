<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

     # بتحط الداتا بتاعتك هنا علشان متستدعهاش في كل رووت ..لو مملتش داتا في عنصر من العناصر ال تحت دي مش هيعمل كرييت لازم تحط فيه داتا علشان تعمل كرييت

    public function rules(): array
    {
        return ([
            'title' => 'required|max:255',
            'description' => '  required',
            'long_description' => 'required'
        ]);
    }
}
