<?php
namespace App\Traits;

use App\Repository\SpecificationRepository;

trait HelpersTrait
{

    public function __construct(SpecificationRepository $specificationRepository)
    {
        $this->specificationRepository = $specificationRepository;
    }

    /**
     * @return array $options
     */
    public function getSpecificationOptions(): array
    {
        $specifications = $this->specificationRepository->findAll();

        $options = [];

        foreach ($specifications as $specification) {
            $specs = [];
            foreach ($specification->getSpecs() as $spec) {
                $specs[$spec] = $spec;
            }
            $options[$specification->getType()] = $specs;
        }
        return $options;
    }

    /**
     * @param array|null $options
     *
     * @return array $res
     */
    public function pickOptions(?array $options = []): array
    {
        $res = [];

        if (is_array($options)) {
            for ($i = 0; $i < random_int(1, count($options)); $i++) {
                $res[] = $options[$i];
            }
        }

        return $res;
    }

}
