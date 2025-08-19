<?php

namespace App\Models;

use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Training extends Model
{
    public static $training;
    public static $data, $image, $imageName, $directory, $extension, $imgURL;

//    saveData
    public static function saveData($request)
    {
        $datePrefix = now()->format('Ymd'); // e.g., 20250520

        $id = IdGenerator::generate([
            'table' => 'trainings',
            'field' => 'training_id',
            'length' => 18, // Prefix + 6 digits
            'prefix' => 'SXAT' . $datePrefix . 'A' . Auth::id() . 'S',
            'reset_on_prefix_change' => true,
        ]);

        self::$training = new Training();
        self::$training->training_id          = $id;
        self::$training->training_name        = $request->training_name;
        self::$training->training_category_id = $request->training_category_id;
        self::$training->trainer_id           = $request->trainer_id;
        self::$training->trainer_type_id      = $request->trainer_type_id;
        self::$training->skill_level_id       = $request->skill_level_id;
        self::$training->language_id          = $request->language_id;
        self::$training->trainingDetails      = $request->trainingDetails;
        self::$training->learning_outcome     = $request->learning_outcome;
        self::$training->lecture              = $request->lecture;
        self::$training->duration             = $request->duration;
        self::$training->assessment           = $request->assessment;
        self::$training->quizzes              = $request->quizzes;
        self::$training->prerequisite         = $request->prerequisite;
        self::$training->certification        = $request->certification;
        self::$training->regular_fees         = $request->regular_fees;
        self::$training->current_fees         = $request->current_fees;
        self::$training->image_path           = self::getImageUrl($request);
        self::$training->status               = $request->status;
        self::$training->author_id            = Auth::id();

        // ✅ First save the training
        self::$training->save();

        // ✅ Then create curriculum items
        foreach ($request->trainingCurriculum as $item) {
            self::$training->trainingCurricula()->create([
                'title'       => $item['title'],
                'sub_title'   => $item['sub_title'] ?? null,
                'description' => $item['description'] ?? null,
                'duration'    => $item['duration'],
            ]);
        }
    }



//    image url
    public static function getImageUrl($request){
        if ($request->hasFile('image')) {
            self::$image = $request->file('image');
            self::$extension = self::$image->extension();
            self::$imageName = $request->name .'.'. uniqid() . '.' . self::$extension;
            self::$directory = 'backend/images/training/';
            self::$image->move(self::$directory, self::$imageName);
            self::$imgURL = self::$directory . self::$imageName;
        } else {
            // Set default image URL if no file is uploaded
            self::$imgURL = 'backend/images/training/defaultImage.jpg';
        }
        return self::$imgURL;
    }


//    updateData
    public static function updateData($request, $id)
    {
        // Get the training
        self::$training = Training::findOrFail($id);

        // Do NOT update training_id here if it’s unique and set only once during creation
        // self::$training->training_id = $id; // ❌ REMOVE THIS IF training_id IS UNIQUE

        // Update training fields
        self::$training->training_name        = $request->training_name;
        self::$training->training_category_id = $request->training_category_id;
        self::$training->trainer_id           = $request->trainer_id;
        self::$training->trainer_type_id      = $request->trainer_type_id;
        self::$training->skill_level_id       = $request->skill_level_id;
        self::$training->language_id          = $request->language_id;
        self::$training->trainingDetails      = $request->trainingDetails;
        self::$training->learning_outcome     = $request->learning_outcome;
        self::$training->lecture              = $request->lecture;
        self::$training->duration             = $request->duration;
        self::$training->assessment           = $request->assessment;
        self::$training->quizzes              = $request->quizzes;
        self::$training->prerequisite         = $request->prerequisite;
        self::$training->certification        = $request->certification;
        self::$training->regular_fees         = $request->regular_fees;
        self::$training->current_fees         = $request->current_fees;
        self::$training->status               = $request->status;
        self::$training->author_id            = Auth::id();

        // ✅ Image update (only if a new image is uploaded)
        if ($request->hasFile('image')) {
            // Delete old image
            if (self::$training->image_path && file_exists(public_path(self::$training->image_path))) {
                unlink(public_path(self::$training->image_path));
            }

            // Store new image
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/trainings'), $imageName);
            self::$training->image_path = 'uploads/trainings/' . $imageName;
        }

        // Save training
        self::$training->save();

        // ✅ Update or create curriculum items
        $existingIds = self::$training->trainingCurricula()->pluck('id')->toArray();
        $incomingIds = [];

        foreach ($request->trainingCurriculum as $item) {
            if (!empty($item['id']) && in_array($item['id'], $existingIds)) {
                // Update existing item
                $curriculum = self::$training->trainingCurricula()->find($item['id']);
                if ($curriculum) {
                    $curriculum->update([
                        'title'       => $item['title'],
                        'sub_title'   => $item['sub_title'] ?? null,
                        'description' => $item['description'] ?? null,
                        'duration'    => $item['duration'],
                    ]);
                    $incomingIds[] = $item['id'];
                }
            } else {
                // Create new item
                $new = self::$training->trainingCurricula()->create([
                    'title'       => $item['title'],
                    'sub_title'   => $item['sub_title'] ?? null,
                    'description' => $item['description'] ?? null,
                    'duration'    => $item['duration'],
                ]);
                $incomingIds[] = $new->id;
            }
        }

        // ✅ Delete removed items
        $toDelete = array_diff($existingIds, $incomingIds);
        if (!empty($toDelete)) {
            self::$training->trainingCurricula()->whereIn('id', $toDelete)->delete();
        }
    }




//    statusUpdate
    public static function statusUpdate($id)
    {
        self::$training   = Training::find($id);
        if(self::$training->status == 1)
        {
            self::$training->status = 0;
        }
        else
        {
            self::$training->status = 1;
        }
        self::$training->save();
    }

//  deleteData
    public static function deleteData($id)
    {
        $data = Training::find($id);

        if (!$data) {
            return false; // or throw an exception
        }

        // Delete the image if it exists
        if ($data->image_path && file_exists(public_path($data->image_path))) {
            unlink(public_path($data->image_path));
        }

        // Delete the record from the database
        $data->delete();

        return true;
    }



//    many to one with Training Category
    public function trainingCategory()
    {
        return $this->belongsTo(TrainingCategory::class, 'training_category_id');
    }
//    many ot one with trainer
    public function trainer(){
        return $this->belongsTo(Trainer::class);
    }

    //    many ot one with trainer type
    public function trainerType(){
        return $this->belongsTo(TrainerType::class);
    }

    //    many ot one with tlanguage
    public function language(){
        return $this->belongsTo(Language::class);
    }

    //    many ot one with skillLevel
    public function skillLevel(){
        return $this->belongsTo(SkillLevel::class);
    }

    public function customerPayment()
    {
        return $this->belongsTo(CustomerPayment::class, 'course_id'); // assuming course_id refers to training ID
    }

    public function trainingCurricula()
    {
        return $this->hasMany(TrainingCurriculum::class, 'training_id');
    }

    public function trainingCurriculam()
    {
        return $this->hasMany(TrainingCurriculum::class, 'training_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(TrainingCategory::class, 'training_category_id');
    }

    public function labCredentials()
    {
        return $this->hasMany(LabAccessCredential::class);
    }

    public function reviews()
    {
        return $this->hasMany(TrainingProgramReview::class, 'training_id');
    }


}
