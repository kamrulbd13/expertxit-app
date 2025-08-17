<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class KidsProgramming extends Model
{
    protected $table = 'kids_programmings';

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
        $programme->image_path = self::handleImageUpload($request);
        $programme->status = $request->status ?? 1;
        $programme->author_id = Auth::id();
        $programme->save();

        if (!empty($request->kidsProgrammeCurriculum)) {
            foreach ($request->kidsProgrammeCurriculum as $item) {
                $programme->kidsProgrammeCurricula()->create([
                    'kids_programme_id' => $programme->kidsProgramme_id,
                    'title'       => $item['title'],
                    'sub_title'   => $item['sub_title'] ?? null,
                    'description' => $item['description'] ?? null,
                    'duration'    => $item['duration'],
                ]);
            }
        }
    }

    public static function updateData($request, $id)
    {
        $programme = self::findOrFail($id);

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
        $programme->status = $request->status;
        $programme->author_id = Auth::id();

        if ($request->hasFile('image')) {
            if ($programme->image_path && file_exists(public_path($programme->image_path))) {
                unlink(public_path($programme->image_path));
            }
            $programme->image_path = self::handleImageUpload($request);
        }

        $programme->save();

        // Sync Curriculum
        $existingIds = $programme->kidsProgrammeCurricula()->pluck('id')->toArray();
        $incomingIds = [];

        foreach ($request->kidsProgrammeCurriculum as $item) {
            if (!empty($item['id']) && in_array($item['id'], $existingIds)) {
                $programme->kidsProgrammeCurricula()
                    ->where('id', $item['id'])
                    ->update([
                        'title'       => $item['title'],
                        'sub_title'   => $item['sub_title'] ?? null,
                        'description' => $item['description'] ?? null,
                        'duration'    => $item['duration'],
                    ]);
                $incomingIds[] = $item['id'];
            } else {
                $new = $programme->kidsProgrammeCurricula()->create([
                    'kids_programme_id' => $programme->kidsProgramme_id,
                    'title'       => $item['title'],
                    'sub_title'   => $item['sub_title'] ?? null,
                    'description' => $item['description'] ?? null,
                    'duration'    => $item['duration'],
                ]);
                $incomingIds[] = $new->id;
            }
        }

        $toDelete = array_diff($existingIds, $incomingIds);
        if (!empty($toDelete)) {
            $programme->kidsProgrammeCurricula()->whereIn('id', $toDelete)->delete();
        }
    }

    protected static function handleImageUpload($request)
    {
        if ($request->hasFile('image')) {
            $image      = $request->file('image');
            $imageName  = uniqid('kp_') . '.' . $image->getClientOriginalExtension();
            $directory  = 'backend/images/kidsProgramme/';
            $image->move(public_path($directory), $imageName);
            return $directory . $imageName;
        }
        return 'backend/images/kidsProgramme/defaultImage.jpg';
    }

    public static function statusUpdate($id)
    {
        $programme = self::findOrFail($id);
        $programme->status = !$programme->status;
        $programme->save();
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
        return $this->hasMany(KidsProgramingCurriculum::class, 'kids_programme_id', 'kidsProgramme_id');
    }

    //    many ot one with skillLevel
    public function skillLevel(){
        return $this->belongsTo(SkillLevel::class);
    }

    //    many ot one with tlanguage
    public function language(){
        return $this->belongsTo(Language::class);
    }

    //    many ot one with trainer
    public function trainer(){
        return $this->belongsTo(Trainer::class);
    }

    //    many ot one with trainer type
    public function trainerType(){
        return $this->belongsTo(TrainerType::class);
    }

    public function category()
    {
        return $this->belongsTo(KidsProgrammingCategory::class, 'kidsProgramming_category_id');
    }


}
