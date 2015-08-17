<?php

namespace CodeProject\Repositories;

use CodeProject\Entities\Client;
use Prettus\Repository\Eloquent\BaseRepository;
use CodeProject\Presenters\ProjectClientPresenter;

class ClientRepositoryEloquent extends BaseRepository implements ClientRepository
{
	
	public function model()
	{
		return Client::class;
	}

    public function presenter()
    {
        return ProjectClientPresenter::class;
    }

}