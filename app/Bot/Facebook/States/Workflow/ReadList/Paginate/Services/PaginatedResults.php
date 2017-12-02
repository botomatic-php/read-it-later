<?php

namespace App\Bot\Facebook\States\Workflow\ReadList\Paginate\Services;

use Botomatic\Engine\Facebook\Abstracts\States\Support\Pagination;

class PaginatedResults extends Pagination
{

    /**
     * @var \Botomatic\Engine\Core\Entities\User
     */
    protected $user;

    /**
     * PaginatedResults constructor.
     * @param \Botomatic\Engine\Core\Entities\User $user
     */
    public function __construct(\Botomatic\Engine\Core\Entities\User $user)
    {
        $this->user = $user;

        $this->serialization = ['user'];

        $this->total = \DB::table('read_list')
            ->where('user_id', $this->user->getId())
            ->count();

        $this->results_left = $this->total;

        $this->per_page = 8;
    }

    /**
     * @param int $offset
     *
     * @return array
     */
    protected function query(int $offset = 0): array
    {
        return \DB::table('read_list')
            ->where('user_id', $this->user->getId())
            ->skip($offset)
            ->take($this->per_page)
            ->get()
            ->toArray();
    }
}
