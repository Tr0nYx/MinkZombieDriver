<?php

/*
 * This file is part of the Behat\Mink.
 * (c) Konstantin Kudryashov <ever.zet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Behat\Mink\Driver\NodeJS\Server;

use Behat\Mink\Driver\NodeJS\Connection;
use Behat\Mink\Driver\NodeJS\Server;
use Behat\Mink\Exception\DriverException;

class ZombieServer extends Server
{
    const ERROR_PREFIX = 'CAUGHT_ERROR:';

    /**
     * {@inheritdoc}
     */
    protected function doEvalJS(Connection $conn, $str, $returnType = 'js')
    {
        switch ($returnType) {
            case 'js':
                $result = $conn->socketSend($str);
                break;

            case 'json':
                $result = $conn->socketSend("stream.end(JSON.stringify({$str}))");
                break;

            default:
                throw new \InvalidArgumentException(sprintf('Invalid return type "%s"', $returnType));
        }

        $errorPrefixLength = strlen(self::ERROR_PREFIX);

        if (self::ERROR_PREFIX === substr($result, 0, $errorPrefixLength)) {
            $errorMessage = json_decode(substr($result, $errorPrefixLength), true);

            throw new DriverException(sprintf('Error "%s" while executing code: %s', $errorMessage, $str));
        }

        if ('json' === $returnType) {
            return json_decode($result);
        }

        return $result;
    }

    protected function createTemporaryServer()
    {
        // If the driver is running in a phar, we need to create a temporary script
        // outside the phar to be usable by node. Otherwise, we use the script directly
        // as this gives a better user experience when zombie is installed locally
        // in the project using the driver (as node will be able to find zombie without
        // having to configure the node modules path).
        if ('phar:' === substr(__DIR__, 0, 5)) {
            return parent::createTemporaryServer();
        }

        case '==':
        case '=':
        case 'eq':
          return (compare === 0);

        case '<>':
        case '!=':
        case 'ne':
          return (compare !== 0);

        case '':
        case '<':
        case 'lt':
          return (compare < 0);
      }

      return null;
  };

  return version_compare(require('%modules_path%zombie/package').version, v2, op);
};

if (false == zombieVersionCompare('2.0.0', '>=')) {
  throw new Error("Your zombie.js version is not compatible with this driver. Please use a version >= 2.0.0");
}

net.createServer(function (stream) {
  stream.setEncoding('utf8');
  stream.allowHalfOpen = true;

  stream.on('data', function (data) {
    buffer += data;
  });

  stream.on('end', function () {
    if (browser == null) {
      browser = new zombie(%options%);

      // Clean up old pointers
      pointers = [];
    }

    try {
      eval(buffer);
      buffer = '';
    } catch (e) {
      buffer = '';
      stream.end('{$errorPrefix}' + JSON.stringify(e.message));
    }

    /**
     * {@inheritdoc}
     */
    protected function getServerScript()
    {
        return file_get_contents(__DIR__.'/../../../bin/mink-zombie-server.js');
    }
}
