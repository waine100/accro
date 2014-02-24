<?php

namespace Zenweb\Aventure\ParcBundle\Component\Generator;
use Symfony\Bridge\Doctrine\RegistryInterface;

class MysqlReference
{
    /**
     * @var RegistryInterface
     */
    protected $registry;

    /**
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        $this->registry = $registry;
    }

    /**
     * {@inheritdoc}
     */
    public function order(OrderInterface $order)
    {
        if (!$order->getId()) {
            throw new \RuntimeException('The order is not persisted into the database');
        }

        $this->generateReference($order, $this->registry->getManager()->getClassMetadata(get_class($order))->table['name']);
    }

    /**
     * generate a correct reference number
     *
     * @param mixed  $object
     * @param string $tableName
     *
     * @throws \Exception
     *
     * @return Exception|string
     */
    protected function generateReference($object, $tableName)
    {
        $date = new \DateTime;

        $sql = sprintf("SELECT count(id) as counter FROM %s WHERE created_at >= '%s' AND reference IS NOT NULL", $tableName, $date->format('Y-m-d'));

        $this->registry->getConnection()->exec(sprintf('LOCK TABLES %s WRITE', $tableName));

        try {
            $statement = $this->registry->getConnection()->query($sql);
            $row       = $statement->fetch();

            $reference = sprintf('%02d%02d%02d%06d',
                $date->format('y'),
                $date->format('n'),
                $date->format('j'),
                $row['counter'] + 1
            );

            $this->registry->getConnection()->update($tableName, array('reference' => $reference), array('id' => $object->getId()));
            $object->setReference($reference);

        } catch (\Exception $e) {
            $this->registry->getConnection()->exec(sprintf('UNLOCK TABLES'));

            throw $e;
        }

        $this->registry->getConnection()->exec(sprintf('UNLOCK TABLES'));

        return $reference;
    }
} 