<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['name', 'description'];
    //defining a relationship between the Project and the Task models using the tasks method.
    // This is a one-to-many relationship, as a project can have numerous number of tasks,
    // but a task can only belong to a particular project.
    public function tasks()
    {
      return $this->hasMany(Task::class);
    }
}
