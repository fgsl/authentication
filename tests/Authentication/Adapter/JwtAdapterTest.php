<?php
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
namespace Fgsl\Test\Authentication\Adapter;
use Fgsl\Authentication\Adapter\JwtAdapter;
use PHPUnit\Framework\TestCase;
use Laminas\Authentication\AuthenticationService;

/**
 *  test case.  
 */
class JwtAdapterTest extends TestCase
{    
    public function testAdapter()
    {
        // Data from https://jwt.io/
        $token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkpvaG4gRG9lIiwiaWF0IjoxNTE2MjM5MDIyfQ.SflKxwRJSMeKKF2QT4fwpMeJf36POk6yJV_adQssw5c';
        $subject = '1234567890';
        $adapter = new JwtAdapter($token, $subject);
        $authentication = new AuthenticationService();
        $authentication->setAdapter($adapter);
        $result = $authentication->authenticate();
        $this->assertTrue($result->isValid());
    }
}

