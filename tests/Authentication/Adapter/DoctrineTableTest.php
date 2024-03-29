<?php
namespace Fgsl\Test\Authentication\Adapter;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query;
use Fgsl\Authentication\Adapter\DoctrineTable;

/**
 *  FGSL Authentication
 *  @author Flávio Gomes da Silva Lisboa <flavio.lisboa@fgsl.eti.br>
 *  @copyright FGSL 2021
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU Affero General Public License as
 *  published by the Free Software Foundation, either version 3 of the
 *  License, or (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU Affero General Public License for more details.

 *  You should have received a copy of the GNU Affero General Public License
 *  along with this program.  If not, see <https://www.gnu.org/licenses/>.
 */
class DoctrineTableTest extends \PHPUnit\Framework\TestCase
{    
    public function testAdapter()
    {
        $this->expectException(\Doctrine\ORM\Query\QueryException::class);
        $entityManager = $this->createMock(EntityManager::class);
        $entityManager->method('getConfiguration')->willReturn(new Configuration());
        $entityManager->method('createQuery')->willReturn(new Query($entityManager));        
        $adapter = new DoctrineTable($entityManager);
        $adapter->setEntityName('users');
        $adapter->setIdentity('identity');
        $adapter->setCredential('credential');
        $adapter->authenticate();
    }
}

