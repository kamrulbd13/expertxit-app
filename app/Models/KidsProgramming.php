<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class KidsProgramming extends Model
{
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

    public static function saveData($request)
    {
        $id = IdGenerator::generate([
            'table' => 'kids_programmings',
            'field' => 'kidsProgramme_id',
            'length' => 18,
            'prefix' => 'SXAT' . now()->format('Ymd') . 'A' . Auth::id() . 'S',
            'reset_on_prefix_change' => true,
        ]);

        $kidsProgramming = self::create([
            'kidsProgramme_id'              => $id,
            'kidsProgramme_name'            => $request->kidsProgramme_name,
            'kidsProgramming_category_id'   => $request->kidsProgramming_category_id,
            'trainer_id'                    => $request->trainer_id,
            'trainer_type_id'               => $request->trainer_type_id,
            'skill_level_id'                => $request->skill_level_id,
            'language_id'                   => $request->language_id,
            'trainingDetails'               => $request->trainingDetails,
            'learning_outcome'              => $request->learning_outcome,
            'lecture'                       => $request->lecture,
            'duration'                      => $request->duration,
            'assessment'                    => $request->assessment,
            'quizzes'                       => $request->quizzes,
            'prerequisite'                  => $request->prerequisite,
            'certification'                 => $request->certification,
            'regular_fees'                  => $request->regular_fees,
            'current_fees'                  => $request->current_fees,
            'image_path'                    => self::storeImage($request),
            'status'                        => $request->status,
            'author_id'                     => Auth::id(),
        ]);

        // Save curriculum items
        if (!empty($request->KidsProgrammeCurriculum)) {
            foreach ($request->KidsProgrammeCurriculum as $item) {
                $kidsProgramming->kidsProgrammeCurricula()->create([
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
        $kidsProgramming = self::findOrFail($id);

        $kidsProgramming->update([
            'kidsProgramme_name'            => $request->kidsProgramme_name,
            'kidsProgramming_category_id'   => $request->kidsProgramming_category_id,
            'trainer_id'                    => $request->trainer_id,
            'trainer_type_id'               => $request->trainer_type_id,
            'skill_level_id'                => $request->skill_level_id,
            'language_id'                   => $request->language_id,
            'trainingDetails'               => $request->trainingDetails,
            'learning_outcome'              => $request->learning_outcome,
            'lecture'                       => $request->lecture,
            'duration'                      => $request->duration,
            'assessment'                    => $request->assessment,
            'quizzes'                       => $request->quizzes,
            'prerequisite'                  => $request->prerequisite,
            'certification'                 => $request->certification,
            'regular_fees'                  => $request->regular_fees,
            'current_fees'                  => $request->current_fees,
            'status'                        => $request->status,
            'image_path'                    => $request->hasFile('image')
                ? self::storeImage($request, $kidsProgramming->image_path)
                : $kidsProgramming->image_path,
        ]);

        // Update curriculum
        $existingIds = $kidsProgramming->kidsProgrammeCurricula()->pluck('id')->toArray();
        $incomingIds = [];

        foreach ($request->KidsProgrammeCurriculum as $item) {
            if (!empty($item['id']) && in_array($item['id'], $existingIds)) {
                $kidsProgramming->kidsProgrammeCurricula()->find($item['id'])->update($item);
                $incomingIds[] = $item['id'];
            } else {
                $new = $kidsProgramming->kidsProgrammeCurricula()->create($item);
                $incomingIds[] = $new->id;
            }
        }

        $toDelete = array_diff($existingIds, $incomingIds);
        if ($toDelete) {
            $kidsProgramming->kidsProgrammeCurricula()->whereIn('id', $toDelete)->delete();
        }
    }

    private static function storeImage($request, $oldPath = null)
    {
        if ($request->hasFile('image')) {
            if ($oldPath && Storage::exists($oldPath)) {
                Storage::delete($oldPath);
            }
            return $request->file('image')->store('kidsProgramming', 'public');
        }
        return $oldPath ?? 'kidsProgramming/defaultImage.jpg';
    }

    // Relationships
    public function kidsProgrammeCategory()
    {
        return $this->belongsTo(KidsProgrammingCategory::class, 'kidsProgramming_category_id');
    }

    public function trainer()
    {
        return $this->belongsTo(Trainer::class);
    }

    public function trainerType()
    {
        return $this->belongsTo(TrainerType::class);
    }

    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    public function skillLevel()
    {
        return $this->belongsTo(SkillLevel::class);
    }

    public function kidsProgrammeCurricula()
    {
        return $this->hasMany(KidsProgramingCurriculum::class, 'kidsProgramme_id');
    }

    public function labCredentials()
    {
        return $this->hasMany(LabAccessCredential::class);
    }
}
