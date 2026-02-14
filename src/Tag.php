<?php

namespace AlwaysBlank\Brick;

use AlwaysBlank\Brick\Attribute\IsVoid;
use AlwaysBlank\Brick\Interface\IsTag;

enum Tag: string implements IsTag {
	case A = 'a';
	case ABBR = 'abbr';
	case ADDRESS = 'address';
	case ARTICLE = 'article';
	case ASIDE = 'aside';
	case AUDIO = 'audio';
	case B = 'b';
	case BDI = 'bdi';
	case BDO = 'bdo';
	case BLOCKQUOTE = 'blockquote';
	case BODY = 'body';
	case BUTTON = 'button';
	case CANVAS = 'canvas';
	case CAPTION = 'caption';
	case CITE = 'cite';
	case CODE = 'code';
	case COLGROUP = 'colgroup';
	case DATA = 'data';
	case DATALIST = 'datalist';
	case DD = 'dd';
	case DEL = 'del';
	case DETAILS = 'details';
	case DFN = 'dfn';
	case DIALOG = 'dialog';
	case DIV = 'div';
	case DL = 'dl';
	case DT = 'dt';
	case EM = 'em';
	case FIELDSET = 'fieldset';
	case FIGCAPTION = 'figcaption';
	case FIGURE = 'figure';
	case FOOTER = 'footer';
	case FORM = 'form';
	case H1 = 'h1';
	case H2 = 'h2';
	case H3 = 'h3';
	case H4 = 'h4';
	case H5 = 'h5';
	case H6 = 'h6';
	case HEAD = 'head';
	case HEADER = 'header';
	case HGROUP = 'hgroup';
	case HTML = 'html';
	case I = 'i';
	case IFRAME = 'iframe';
	case INS = 'ins';
	case KBD = 'kbd';
	case LABEL = 'label';
	case LEGEND = 'legend';
	case LI = 'li';
	case MAIN = 'main';
	case MAP = 'map';
	case MARK = 'mark';
	case MENU = 'menu';
	case METER = 'meter';
	case NAV = 'nav';
	case NOSCRIPT = 'noscript';
	case OBJECT = 'object';
	case OL = 'ol';
	case OPTGROUP = 'optgroup';
	case OPTION = 'option';
	case OUTPUT = 'output';
	case P = 'p';
	case PICTURE = 'picture';
	case PRE = 'pre';
	case PROGRESS = 'progress';
	case Q = 'q';
	case RP = 'rp';
	case RT = 'rt';
	case RUBY = 'ruby';
	case S = 's';
	case SAMP = 'samp';
	case SCRIPT = 'script';
	case SECTION = 'section';
	case SELECT = 'select';
	case SMALL = 'small';
	case SPAN = 'span';
	case STRONG = 'strong';
	case STYLE = 'style';
	case SUB = 'sub';
	case SUMMARY = 'summary';
	case SUP = 'sup';
	case TABLE = 'table';
	case TBODY = 'tbody';
	case TD = 'td';
	case TEMPLATE = 'template';
	case TEXTAREA = 'textarea';
	case TFOOT = 'tfoot';
	case TH = 'th';
	case THEAD = 'thead';
	case TIME = 'time';
	case TITLE = 'title';
	case TR = 'tr';
	case U = 'u';
	case UL = 'ul';
	case VAR = 'var';
	case VIDEO = 'video';

	// Void tags.
	#[IsVoid]
	case AREA = 'area';
	#[IsVoid]
	case BASE = 'base';
	#[IsVoid]
	case BR = 'br';
	#[IsVoid]
	case COL = 'col';
	#[IsVoid]
	case EMBED = 'embed';
	#[IsVoid]
	case HR = 'hr';
	#[IsVoid]
	case IMG = 'img';
	#[IsVoid]
	case INPUT = 'input';
	#[IsVoid]
	case LINK = 'link';
	#[IsVoid]
	case META = 'meta';
	#[IsVoid]
	case PARAM = 'param';
	#[IsVoid]
	case SOURCE = 'source';
	#[IsVoid]
	case TRACK = 'track';
	#[IsVoid]
	case WBR = 'wbr';

	public function is_void(): bool {
		$ref = (new \ReflectionEnumBackedCase( __CLASS__, $this->name ))
			->getAttributes(IsVoid::class)[0] ?? null;
		if (null === $ref) {
			return false;
		}

		return $ref->getName() === IsVoid::class;
	}

	public function tag(): string {
		return $this->value;
	}
}
