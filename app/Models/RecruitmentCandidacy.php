<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class RecruitmentCandidacy
 * @author Alexandre Ribes
 * @package App\Models
 */
class RecruitmentCandidacy extends Model
{
    protected $table = 'recruitments_candidacies';

    protected $fillable = ['recruitment_id', 'name', 'firtname', 'email', 'phone', 'file', 'siret', 'content', 'begin_at', 'birthday'];

    protected $dates = ['begin_at', 'birthday'];

    /**
     * Offre associée
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function recruitment()
    {
        return $this->belongsTo(Recruitment::class, 'recruitment_id');
    }
}
