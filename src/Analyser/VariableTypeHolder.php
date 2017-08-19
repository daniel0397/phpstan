<?php declare(strict_types = 1);

namespace PHPStan\Analyser;

use PHPStan\TrinaryLogic;
use PHPStan\Type\Type;

class VariableTypeHolder
{

	/**
	 * @var \PHPStan\Type\Type
	 */
	private $type;

	/**
	 * @var \PHPStan\TrinaryLogic
	 */
	private $certainty;

	public function __construct(Type $type, TrinaryLogic $certainty)
	{
		if ($certainty->no()) {
			throw new \PHPStan\ShouldNotHappenException();
		}
		$this->type = $type;
		$this->certainty = $certainty;
	}

	public static function createYes(Type $type): self
	{
		return new self($type, TrinaryLogic::createYes());
	}

	public function getType(): Type
	{
		return $this->type;
	}

	public function getCertainty(): TrinaryLogic
	{
		return $this->certainty;
	}

}