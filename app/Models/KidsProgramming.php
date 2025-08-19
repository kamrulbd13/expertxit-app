<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class KidsProgramming extends Model
{
    protected $table = 'kids_programmings';
    public static $data, $image, $imageName, $directory, $extension, $imgURL;

    protected $fillable = [
        'kidsProgramme_id',
        'kidsProgramme_name',
        'kidsProgramming_category_id',
        'trainer_id',
        'trainer_type_id',
        'skill_level_id',
        'language_id',
        'trainingDetails',
        'learning_outcome',
        'lecture',
        'duration',
        'assessment',
        'quizzes',
        'prerequisite',
        'certification',
        'regular_fees',
        'current_fees',
        'image_path',
        'status',
        'author_id',
    ];

    /* ===================== CRUD Methods ===================== */

    public static function saveData($request)
    {
        $datePrefix = now()->format('Ymd');

        $id = IdGenerator::generate([
            'table' => 'kids_programmings',
            'field' => 'kidsProgramme_id',
            'length' => 18,
            'prefix' => 'KP' . $datePrefix . 'A' . Auth::id() . 'S',
            'reset_on_prefix_change' => true,
        ]);

        $programme = new self();
        $programme->kidsProgramme_id = $id;
        $programme->kidsProgramme_name = $request->kidsProgramme_name;
        $programme->kidsProgramming_category_id = $request->kidsProgramming_category_id;
        $programme->trainer_id = $request->trainer_id;
        $programme->trainer_type_id = $request->trainer_type_id;
        $programme->skill_level_id = $request->skill_level_id;
        $programme->language_id = $request->language_id;
        $programme->trainingDetails = $request->trainingDetails;
        $programme->learning_outcome = $request->learning_outcome;
        $programme->lecture = $request->lecture;
        $programme->duration = $request->duration;
        $programme->assessment = $request->assessment;
        $programme->quizzes = $request->quizzes;
        $programme->prerequisite = $request->prerequisite;
        $programme->certification = $request->certification;
        $programme->regular_fees = $request->regular_fees;
        $programme->current_fees = $request->current_fees;
        $programme->image_path = self::getImageUrl($request);
        $programme->status = $request->status ?? 1;
        $programme->author_id = Auth::id();
        $programme->save();

// Save Curricula
        $curriculaData = $request->trainingCurriculum; // use the correct key from the request

        if (!empty($curriculaData) && is_array($curriculaData)) {
            foreach ($curriculaData as $item) {
                if (!empty($item['title'])) {
                    $programme->kidsProgrammeCurricula()->create([
                        'kidsProgramme_id' => $programme->id,
                        'title' => $item['title'],
                        'sub_title' => $item['sub_title'] ?? null,
                        'description' => $item['description'] ?? null,
                        'duration' => $item['duration'] ?? null,
                    ]);
                }
            }
        }

        return $programme;
    }

    public static function updateData($request, $id)
    {

        $programme = self::findOrFail($id);

        // Update main programme
        $programme->update([
            'kidsProgramme_name' => $request->kidsProgramme_name,
            'kidsProgramming_category_id' => $request->kidsProgramming_category_id,
            'trainer_id' => $request->trainer_id,
            'trainer_type_id' => $request->trainer_type_id,
            'skill_level_id' => $request->skill_level_id,
            'language_id' => $request->language_id,
            'trainingDetails' => $request->trainingDetails,
            'learning_outcome' => $request->learning_outcome,
            'lecture' => $request->lecture,
            'duration' => $request->duration,
            'assessment' => $request->assessment,
            'quizzes' => $request->quizzes,
            'prerequisite' => $request->prerequisite,
            'certification' => $request->certification,
            'regular_fees' => $request->regular_fees,
            'current_fees' => $request->current_fees,
            'status' => $request->status,
            'author_id' => Auth::id(),
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            if ($programme->image_path && file_exists(public_path($programme->image_path))) {
                unlink(public_path($programme->image_path));
            }
            $programme->image_path = self::getImageUrl($request);
            $programme->save();
        }

        // Sync Curricula
        $curriculaData = $request->trainingCurriculum ?? []; // match the request input name
        $existingIds = $programme->kidsProgrammeCurricula()->pluck('id')->toArray();
        $incomingIds = [];

        if (!empty($curriculaData) && is_array($curriculaData)) {
            foreach ($curriculaData as $item) {
                if (!empty($item['id']) && in_array($item['id'], $existingIds)) {
                    // Update existing curriculum
                    $programme->kidsProgrammeCurricula()->where('id', $item['id'])->update([
                        'title' => $item['title'],
                        'sub_title' => $item['sub_title'] ?? null,
                        'description' => $item['description'] ?? null,
                        'duration' => $item['duration'] ?? null,
                    ]);
                    $incomingIds[] = $item['id'];
                } elseif (!empty($item['title'])) {
                    // Create new curriculum
                    $new = $programme->kidsProgrammeCurricula()->create([
                        'kidsProgramme_id' => $programme->id,
                        'title' => $item['title'],
                        'sub_title' => $item['sub_title'] ?? null,
                        'description' => $item['description'] ?? null,
                        'duration' => $item['duration'] ?? null,
                    ]);
                    $incomingIds[] = $new->id;
                }
            }
        }

        // Delete removed curricula
        $toDelete = array_diff($existingIds, $incomingIds);
        if (!empty($toDelete)) {
            $programme->kidsProgrammeCurricula()->whereIn('id', $toDelete)->delete();
        }

        return $programme;
    }


//    image url
    public static function getImageUrl($request){
        if ($request->hasFile('image')) {
            self::$image = $request->file('image');
            self::$extension = self::$image->extension();
            self::$imageName = $request->name .'.'. uniqid() . '.' . self::$extension;
            self::$directory = 'backend/images/kidsProgramme/';
            self::$image->move(self::$directory, self::$imageName);
            self::$imgURL = self::$directory . self::$imageName;
        } else {
            // Set default image URL if no file is uploaded
            self::$imgURL = 'backend/images/kidsProgramme/defaultImage.jpg';
        }
        return self::$imgURL;
    }


    public static function statusUpdate($id)
    {
        $programme = self::findOrFail($id);
        $programme->status = !$programme->status;
        $programme->save();

        return $programme;
    }

    public static function deleteData($id)
    {
        $programme = self::find($id);
        if (!$programme) return false;

        if ($programme->image_path && file_exists(public_path($programme->image_path))) {
            unlink(public_path($programme->image_path));
        }

        $programme->kidsProgrammeCurricula()->delete();
        $programme->delete();

        return true;
    }

    /* ===================== Relationships ===================== */

    public function kidsProgrammeCurricula()
    {
        return $this->hasMany(KidsProgramingCurriculum::class, 'kidsProgramme_id', 'id');
    }

    public function kidsProgrammeCurriculum()
    {
        return $this->hasMany(KidsProgramingCurriculum::class, 'kidsProgramme_id', 'id');
    }

    public function reviews()
    {
        return $this->hasMany(KidsProgramReview::class, 'kidsProgramme_id');
    }
    public function skillLevel()
    {
        return $this->belongsTo(SkillLevel::class);
    }

    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    public function trainer()
    {
        return $this->belongsTo(Trainer::class);
    }

    public function trainerType()
    {
        return $this->belongsTo(TrainerType::class);
    }

    public function category()
    {
        return $this->belongsTo(KidsProgrammingCategory::class, 'kidsProgramming_category_id');
    }
}
