<?php

namespace App\Service\Handler\Metabase;

use App\Entity\MetaBase;
use App\Repository\MetaBaseRepository;

class HandlerMetabase
{
    
    private MetaBaseRepository $metaBaseRepository;

    /**
     * HandlerMetabase constructor.
     * @param MetaBaseRepository $metaBaseRepository
     */
    public function __construct(MetaBaseRepository $metaBaseRepository)
    {
        $this->metaBaseRepository = $metaBaseRepository;
    }

    /**
     * @param null $base <b>base</b> del cual queremos la metadata, vacío para el index
     * @return MetaBase|null
     */
    public function metadatos($base = null): ?MetaBase
    {
        if(!$base){
            $base = 'index';
        }
        return $this->metaBaseRepository->findOneBy(['base'=>$base]);
    }
    

}