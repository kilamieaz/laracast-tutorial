<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('update', $this->project());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'sometimes|required',
            'description' => 'sometimes|required',
            'notes' => 'min:3'
        ];
    }

    public function project()
    {
        // #ROUTE MODEL BINDING
        // projects/{project} = $this->route('project') = Project::find({project});
        // $this->route('project') == $request->route('project')
        // (without RMB) return Project::findOrFail($this->route('project'));
        return $this->route('project');
    }

    public function save()
    {
        // validated() = access to the validated attributes
        // $this->validated() == $request->validated()

        // #LARAVEL TAP (higher order)
        // $project = $this->project();
        // $project->update($this->validated());
        // return $project;
        return tap($this->project())->update($this->validated());
    }
}
