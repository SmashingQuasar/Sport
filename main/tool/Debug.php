<?php

define('JSON_UNESCAPED', \JSON_UNESCAPED_UNICODE | \JSON_UNESCAPED_SLASHES | \JSON_UNESCAPED_LINE_TERMINATORS);

final class Debug
{
	static private $Logger = null;
	static private $Complete = true;
	static private $DumpResources = true;
	static private $DumpDepth = 0;

	static public function StopBuffer() : void
	{
		$level = ob_get_level();

		for ($i=0; $i<$level; ++$i)
		{
			ob_end_clean();
		}
	}

	static public function Dump() : void
	{
		self::StopBuffer();

		if (self::$DumpResources)
		{
			self::DumpStyle();
			self::DumpScript();
			self::$DumpResources = false;
		}

		$args = func_get_args();

		foreach ($args as $arg)
		{
			self::$DumpDepth = 3;
			echo '<dump-root><dump-wrapper><dump-container>';
			self::DumpSwitch($arg);
			echo '</dump-container></dump-wrapper></dump-root>';
		}
	}

	static public function LightDump() : void
	{
		self::StopBuffer();

		if (self::$DumpResources)
		{
			self::DumpStyle();
			self::DumpScript();
			self::$DumpResources = false;
		}

		self::$Complete = false;
		$args = func_get_args();

		foreach ($args as $arg)
		{
			self::$DumpDepth = 3;
			echo '<dump-root><dump-wrapper><dump-container>';
			self::DumpSwitch($arg);
			echo '</dump-container></dump-wrapper></dump-root>';
		}

		self::$Complete = true;
	}

	static private function DumpStyle() : void
	{
		echo '
		<style>
		dump-root
		{
			float: left;
			clear: both;
			max-width: calc(97vw - 10px);
			margin: calc(5px + 1vw);
			padding: 0;
			overflow-x: hidden;
			overflow-y: visible;
		}
		dump-wrapper
		{
			border: 1px solid black;
			padding	: 3px;
			background-color: green;
			overflow-x: hidden;
			overflow-y: visible;
		}
		dump-container
		{
			width: 100vw;
			width: -moz-available;
			max-width: 100%;
			overflow-x: auto;
			overflow-y: visible;
		}
		dump-root,
		dump-wrapper,
		dump-container,
		dump-object,
		dump-trace,
		dump-array,
		dump-table,
		dump-string,
		dump-scalar,
		dump-key
		{
			display: block;
			box-sizing: border-box;
		}
		dump-root caption,
		dump-root th,
		dump-trace,
		dump-key,
		dump-scalar
		{
			font-size: 13px;
			font-family: monospace;
		}
		dump-root caption,
		dump-root th
		{
			font-weight: bold;
		}
		dump-root th,
		dump-root td
		{
			padding: 2px;
			white-space: nowrap;
		}
		dump-root caption,
		dump-key,
		dump-scalar
		{
			padding: 3px 5px;
		}
		dump-root caption,
		dump-root th,
		dump-key,
		dump-scalar
		{
			white-space: nowrap;
		}
		dump-root table
		{
			border-collapse: collapse;
			width: 100%;
		}
		dump-object,
		dump-trace,
		dump-array,
		dump-table,
		dump-string,
		dump-scalar,
		dump-root tr:nth-child(n+2)
		{
			background-color: whitesmoke;
		}
		dump-root tbody tr:nth-child(odd)
		{
			background-color: lightsteelblue;
		}
		dump-root caption
		{
			cursor: pointer;
			background-color: wheat;
			overflow: hidden;
		}
		dump-object,
		dump-trace,
		dump-array,
		dump-table,
		dump-string,
		dump-scalar,
		dump-table > table > thead > tr > th,
		dump-table > table > tbody > tr > td
		{
			border: 1px solid dimgray;
		}
		dump-root thead + tbody,
		dump-root tr:nth-child(n+2)
		{
			border-top: 1px solid dimgray;
		}
		dump-key
		{
			border: 1px solid transparent;
		}
		dump-root caption
		{
			text-align: left;
		}
		dump-root th,
		dump-root td
		{
			vertical-align: top;
		}
		dump-root th:last-child,
		dump-root td:last-child
		{
			width: 100%;
		}
		dump-trace td:nth-last-child(2)
		{
			text-align: right;
		}
		dump-trace dump-table td:nth-last-child(2)
		{
			text-align: left;
		}
		dump-string dump-scalar
		{
			white-space: pre;
		}
		dump-scalar
		{
			overflow: auto;
		}
		dump-args
		{
			position: relative;
			display: block;
		}
		dump-args ol
		{
			position: absolute;
			top: -95%;
			left: 95%;
			z-index: 1;
			display: none;
			padding: 3px;
			list-style-type: none;
			background-color: green;
		}
		dump-args:hover ol
		{
			display: block;
		}
		dump-args li
		{
			background-color: white;
		}
		dump-args li:nth-child(even)
		{
			background-color: lightsteelblue;
		}
		dump-trace tr:nth-last-child(-n+3) ol
		{
			top: auto;
			bottom: -95%;
		}
		</style>';
	}

	static private function DumpScript() : void
	{
		echo '<script>
			document.addEventListener(
				"mousedown",
				function (event)
				{
					let target = event.target;
					if (target.tagName === "CAPTION" && target.closest("dump-container"))
					{
						event.stopImmediatePropagation();
						event.preventDefault();
						target = target.nextElementSibling;
						if (target)
						{
							const state = !target.hidden;
							if (event.ctrlKey)
							{
								const childs = target.parentNode.querySelectorAll("thead, tbody");
								const length = childs.length;
								let i = 0;
								for (; i < length; ++i)
								{
									childs[i].hidden = state;
								}
							}
							else
							{
								while (target)
								{
									target.hidden = state;
									target = target.nextElementSibling;
								}
							}
						}
					}
				},
				true
			);
		</script>
		';
	}

	static private function DumpSwitch($mixed) : void
	{
		if (is_resource($mixed))
		{
			self::DumpResource($mixed);
		}
		elseif (is_object($mixed))
		{
			if ($mixed instanceof Exception)
			{
				self::DumpException($mixed);
			}
			elseif ($mixed instanceof Asset)
			{
				self::DumpAsset($mixed);
			}
			elseif ($mixed instanceof Document)
			{
				self::DumpDocument($mixed);
			}
			elseif (self::$DumpDepth)
			{
				--self::$DumpDepth;
				self::DumpObject($mixed);
				++self::$DumpDepth;
			}
			else
			{
				echo '(...)';
			}
		}
		elseif (is_array($mixed))
		{
			if (self::IsTwoDimensionalArray($mixed))
			{
				self::DumpTable($mixed);
			}
			else
			{
				self::DumpArray($mixed);
			}
		}
		else
		{
			self::DumpScalar($mixed);
		}
	}

	static public function IsTwoDimensionalArray(array $array) : bool
	{
		if (empty($array) || !is_array($array) || empty(reset($array)))
		{
			return false;
		}

		$keys = array_keys($array);

		if ($keys !== array_keys($keys))
		{
			return false;
		}

		foreach ($array as $row)
		{
			if (!is_array($row))
			{
				return false;
			}

			$keys = array_keys($row);

			if ($keys !== array_keys($keys))
			{
				return false;
			}
			foreach ($row as $cell)
			{
				if (isset($cell) && !is_scalar($cell))
				{
					return false;
				}
			}
		}

		return true;
	}

	static private function DumpResource($resource) : void
	{
		echo '<dump-scalar>Resource: ', get_resource_type($resource), '</dump-scalar>';
	}

	static private function DumpObject($object) : void
	{
		echo '<dump-object><table><caption>',get_class($object),'</caption><tbody>';

		$mirror = new ReflectionObject($object);
		$visibility = ReflectionProperty::IS_PRIVATE | ReflectionProperty::IS_PROTECTED | ReflectionProperty::IS_PUBLIC;

		do
		{
			$properties = $mirror->getProperties($visibility);
			$visibility = ReflectionProperty::IS_PRIVATE;

			foreach ($properties as $property)
			{
				$name = $property->getName();

				if (!in_array($name, ['dao', 'daoClassCache', 'daoClassMap', 'services'], true))
				{
					$property->setAccessible(true);
					echo '<tr><td><dump-key>',$name,'</dump-key></td><td>';
					self::DumpSwitch($property->getValue($object));
					echo '</td></tr>';
				}
			}

			$mirror = $mirror->getParentClass();
		}
		while ($mirror);
	

		echo '</tbody></table></dump-object>';
	}

	static private function DumpException(Exception $exception) : void
	{
		$root = realpath('..');

		while ($exception->getPrevious())
		{
			$exception = $exception->getPrevious();
		}

		$trace = $exception->getTrace();
		array_unshift($trace, ['file' => $exception->getFile(), 'line' => $exception->getLine()]);
		echo '<dump-trace><table><caption>',$exception->getMessage(),'</caption><tbody>';

		foreach ($trace as $row)
		{
			if (isset($row['file'], $row['line']))
			{
				echo '<tr>';

				if (isset($row['function']))
				{
					if (isset($row['class']))
					{
						echo '<td>',$row['class'],'</td><td>',$row['type'],'</td>';
					}
					else
					{
						echo '<td colspan="2"></td>';
					}
					echo '<td>',$row['function'],'</td>';
				}
				else
				{
					echo '<td colspan="3"></td>';
				}

				$file = str_replace($root, '.', $row['file']);
				$file = str_replace('\\', '/', $file);
				echo '<td>',$row['line'],'</td><td>',$file,'</td></tr>';
			}
		}

		echo '</tbody></table></dump-trace>';
	}

	static private function DumpTable(array $table) : void
	{
		$row = reset($table);
		echo '<dump-table><table><caption>Table (',count($table),' rows, ',count($row),' columns)</caption>';
		$columns = array_keys($row);

		if ($columns !== array_keys($columns))
		{
			echo '<thead><tr>';

			foreach ($columns as $column)
			{
				echo '<th>',$column,'</th>';
			}

			echo '</tr></thead>';
		}

		echo '<tbody>';

		foreach ($table as $row)
		{
			echo '<tr>';

			foreach ($row as $cell)
			{
				echo '<td>';
				self::DumpSwitch($cell);
				echo '</td>';
			}

			echo '</tr>';
		}

		echo '</tbody></table></dump-table>';
	}

	static private function DumpArray(array $array) : void
	{
		echo '<dump-array><table><caption>Array (',count($array),' rows)</caption><tbody>';

		foreach ($array as $i => $row)
		{
			echo '<tr><td><dump-key>',$i,'</dump-key></td><td>';
			self::DumpSwitch($row);
			echo '</td></tr>';
		}

		echo '</tbody></table></dump-array>';
	}

	static private function DumpScalar($scalar) : void
	{
		if (is_string($scalar))
		{
			echo
				'<dump-string><table><caption>String (',
				mb_strlen($scalar),
				' characters)</caption><tbody><tr><td><dump-scalar>',
				htmlentities($scalar),
				'</dump-scalar></td></tr></tbody></table></dump-string>';
		}
		else
		{
			echo '<dump-scalar>', json_encode($scalar, JSON_UNESCAPED), '</dump-scalar>';
		}
	}

	static private function DumpDate(string $date) : void
	{
		echo '<dump-scalar>',$date,'</dump-scalar>';
	}

	static public function StackTrace() : void
	{
		self::StopBuffer();

		if (self::$DumpResources)
		{
			self::DumpStyle();
			self::DumpScript();
			self::$DumpResources = false;
		}

		echo '<dump-root><dump-wrapper><dump-container>';
		$root = realpath('..');
		$exception = new Exception('DEBUG TRACE');
		$trace = $exception->getTrace();
		$trace[0]['class'] = null;
		$trace[0]['function'] = null;
		echo '<dump-trace><table><caption>',$exception->getMessage(),'</caption><tbody>';

		foreach ($trace as $row)
		{
			if (isset($row['file'], $row['line']))
			{
				echo '<tr>';

				if (isset($row['function']))
				{
					if (isset($row['class']))
					{
						echo '<td>',$row['class'],'</td><td>',$row['type'],'</td>';
					}
					else
					{
						echo '<td colspan="2"></td>';
					}

					echo '<td>',$row['function'],'</td>';
					$mirror = null;

					if (isset($row['class']))
					{
						if (strpos($row['function'], '\\{closure}') === false)
						{
							$mirror = new ReflectionMethod($row['class'], $row['function']);
						}
					}
					elseif (!in_array($row['function'], ['require', 'require_once', 'include', 'include_once'], true))
					{
						$mirror = new ReflectionFunction($row['function']);
					}

					if (isset($mirror))
					{
						$args = $mirror->getParameters();
						echo '<td><dump-table><table><caption>', count($args), '</caption><tbody hidden>';

						if (!empty($args))
						{
							foreach ($args as $arg)
							{
								echo
								'<tr><td>',
								$arg->getName(),
								'</td><td>',
								($arg->isPassedByReference() ? '&' : ''),
								($arg->hasType() ? $arg->getType() : 'mixed'),
								'</td><td>',
								($arg->isOptional() ? json_encode($arg->getDefaultValue(), JSON_UNESCAPED) : ''),
								'</td></tr>';
							}
						}
						echo '</tbody></table></dump-table></td>';
					}
					else
					{
						echo '<td></td>';
					}
				}
				else
				{
					echo '<td colspan="4"></td>';
				}

				$file = str_replace($root, '.', $row['file']);
				$file = str_replace('\\', '/', $file);
				echo '<td>',$row['line'],'</td><td>',$file,'</td></tr>';
			}
		}

		echo '</tbody></table></dump-trace></dump-container></dump-wrapper></dump-root>';
	}

	static public function GetClassMirror($object)
	{
		if (is_object($object))
		{
			return new ReflectionObject($object);
		}
		else
		{
			return new ReflectionClass($object);
		}
	}

	static public function LocateFunction(string $fullname) : void
	{
		try
		{
			$rf = new ReflectionFunction($fullname);
			self::Dump([
				'function' => $fullname,
				'file' => $rf->getFileName(),
				'line' => $rf->getStartLine()
			]);
		}
		catch (Exception $ex)
		{
			self::Dump($ex->getMessage());
		}
	}

	static public function LocateMethod($object, string $fullname) : void
	{
		try
		{
			$rc = self::GetClassMirror($object);
			$rm = $rc->getMethod($fullname);
			$rc = $rm->getDeclaringClass();
			self::Dump([
				'method' => $fullname,
				'class' => $rc->getName(),
				'file' => $rm->getFileName(),
				'line' => $rm->getStartLine()
			]);
		}
		catch (Exception $ex)
		{
			self::Dump($ex->getMessage());
		}
	}

	static public function LocateClass($object) : void
	{
		try
		{
			$rc = self::GetClassMirror($object);
			self::Dump([
				'class' => $rc->getName(),
				'file' => $rc->getFileName()
			]);
		}
		catch (Exception $ex)
		{
			self::Dump($ex->getMessage());
		}
	}

	static public function LocateProperty($object, string $fullname) : void
	{
		try
		{
			$rc = self::GetClassMirror($object);
			$rp = $rc->getProperty($fullname);
			$rc = $rp->getDeclaringClass();
			self::Dump([
				'property' => $fullname,
				'class' => $rc->getName(),
				'file' => $rc->getFileName()
			]);
		}
		catch (Exception $ex)
		{
			self::Dump($ex->getMessage());
		}
	}

	static public function DumpAncestry($object)
	{
		$mirror = self::GetClassMirror($object);
		$ancestry = [];
		
		while ($mirror)
		{
			$ancestry[] = ['name' => $mirror->getShortName(), 'fullpath' => $mirror->getName()];
			$mirror = $mirror->getParentClass();
		}

		self::Dump($ancestry);
	}

	static public function DumpMethods($object)
	{
		$methods = get_class_methods($object);
		sort($methods);
		self::Dump($methods);
	}

}
