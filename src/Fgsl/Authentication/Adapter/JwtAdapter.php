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
namespace Fgsl\Authentication\Adapter;

use Laminas\Authentication\Adapter\AdapterInterface;
use Laminas\Authentication\Result;
use Fgsl\Jwt\Jwt;

class JwtAdapter implements AdapterInterface
{
    /** @var string **/
    private $token;
    /** @var string **/
    private $subject;    
    
    /**
     * @param string $token
     * @param string $subject
     */
    public function __construct(string $token, string $subject)
    {
        $this->token    = $token;
        $this->subject  = $subject;
    }
 
    /**
     * {@inheritDoc}
     * @see \Laminas\Authentication\Adapter\AdapterInterface::authenticate()
     */
    public function authenticate()
    {
        $payload = Jwt::getPayload($this->token);
        $result = Result::FAILURE_IDENTITY_NOT_FOUND;
        $identity = 'unknown';
        $messages = ['Failure identity not found'];
        if ($payload == false){
            $result = Result::FAILURE_CREDENTIAL_INVALID;
            $messages[] = 'Failure credential invalid';
        } elseif ($payload->sub == $this->subject){            
            $result = Result::SUCCESS;
            $identity = $this->subject;
        }
        return new Result(
            $result,
            $identity,
            $messages
        );        
    }    
}