<?php

namespace AlwaysBlank\Brick\Tag;

use AlwaysBlank\Brick\Interface\ElementAttributeName;

enum AttributeName: string implements ElementAttributeName {
	// Common / global-ish attributes.
	case CL = 'class'; // We can't use `CLASS` because it's reserved.
	case ID = 'id';
	case TITLE = 'title';
	case LANG = 'lang';
	case DIR = 'dir';
	case STYLE = 'style';
	case TABINDEX = 'tabindex';
	case TRANSLATE = 'translate';
	case HIDDEN = 'hidden';
	case CONTENTEDITABLE = 'contenteditable';
	case SPELLCHECK = 'spellcheck';
	case DRAGGABLE = 'draggable';

	// Links / navigation.
	case HREF = 'href';
	case HREFLANG = 'hreflang';
	case REL = 'rel';
	case TARGET = 'target';
	case DOWNLOAD = 'download';

	// Media / sources.
	case ALT = 'alt';
	case SRC = 'src';
	case SRCSET = 'srcset';
	case SIZES = 'sizes';
	case WIDTH = 'width';
	case HEIGHT = 'height';
	case POSTER = 'poster';
	case PRELOAD = 'preload';
	case AUTOPLAY = 'autoplay';
	case CONTROLS = 'controls';
	case LOOP = 'loop';
	case MUTED = 'muted';
	case KIND = 'kind';
	case LABEL = 'label';
	case SRCDOC = 'srcdoc';
	case SRCLANG = 'srclang';

	// Forms / inputs.
	case ACCEPT = 'accept';
	case ACCEPT_CHARSET = 'accept-charset';
	case ACCESSKEY = 'accesskey';
	case ACTION = 'action';
	case AUTOCOMPLETE = 'autocomplete';
	case AUTOFOCUS = 'autofocus';
	case CHECKED = 'checked';
	case DIRNAME = 'dirname';
	case DISABLED = 'disabled';
	case ENCTYPE = 'enctype';
	case FOR = 'for';
	case FORM = 'form';
	case FORMACTION = 'formaction';
	case LIST = 'list';
	case MAX = 'max';
	case MAXLENGTH = 'maxlength';
	case METHOD = 'method';
	case MIN = 'min';
	case MULTIPLE = 'multiple';
	case NAME = 'name';
	case NOVALIDATE = 'novalidate';
	case PATTERN = 'pattern';
	case PLACEHOLDER = 'placeholder';
	case READONLY = 'readonly';
	case REQUIRED = 'required';
	case SIZE = 'size';
	case STEP = 'step';
	case TYPE = 'type';
	case VALUE = 'value';
	case WRAP = 'wrap';
	case SELECTED = 'selected';
	case OPEN = 'open';

	// Tables / layout-ish.
	case COLS = 'cols';
	case COLSPAN = 'colspan';
	case ROWS = 'rows';
	case ROWSPAN = 'rowspan';
	case SPAN = 'span';
	case SCOPE = 'scope';
	case HEADERS = 'headers';

	// Metadata / misc.
	case ASYNC = 'async';
	case CHARSET = 'charset';
	case CITE = 'cite';
	case CONTENT = 'content';
	case COORDS = 'coords';
	case DATA = 'data';
	case DATETIME = 'datetime';
	case DEFAULT = 'default';
	case DEFER = 'defer';
	case HIGH = 'high';
	case HTTP_EQUIV = 'http-equiv';
	case ISMAP = 'ismap';
	case LOW = 'low';
	case MEDIA = 'media';
	case OPTIMUM = 'optimum';
	case REVERSED = 'reversed';
	case SANDBOX = 'sandbox';
	case SHAPE = 'shape';
	case START = 'start';
	case USEMAP = 'usemap';

	/**
	 * Returns the attribute name as it should appear in HTML output.
	 * Kept symmetrical with Tag::tag().
	 */
	public function name() : string {
		return $this->value;
	}

	/**
	 * Self-documenting wrapper around tryFrom() for parsing attribute names.
	 */
	public static function get( string $name ) : ElementAttributeName {
		$tag = self::tryFrom( $name );
		if ( $tag instanceof self ) {
			return $tag;
		}
		return CustomElementAttributeName::factory( $name );
	}
}
