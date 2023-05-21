import assign from 'lodash.assign';
import "./style.scss";
import "./style.editor.scss";
import classnames from "classnames";
import { __ } from "@wordpress/i18n";
const { createHigherOrderComponent } = wp.compose;
const { Fragment } = wp.element;
const { InspectorControls } = wp.blockEditor;
const { PanelBody, SelectControl} = wp.components;
const { addFilter } = wp.hooks;


// Enable Font control on the following blocks
const enableFontControlOnBlocks = [
	`core/button`,
];
const typeFontsControlOptions = [
	{
		label: __( 'None', 'otterwp' ),
		value: '',
	},
	{
		label: __( 'Font One', 'otterwp' ),
		value: 'primary-text',
	},
	{
		label: __( 'Font Two', 'otterwp' ),
		value: 'secondary-text',
	},
	{
		label: __( 'Font Three', 'otterwp' ),
		value: 'third-text',
	},
	{
		label: __( 'Font Four', 'otterwp' ),
		value: 'fourth-text',
	},
	{
		label: __( 'Font Five', 'otterwp' ),
		value: 'fifth-text',
	},
	

];



/**
 * Add Font control attribute to block.
 *
 * @param {object} settings Current block settings.
 * @param {string} name Name of block.
 *
 * @returns {object} Modified block settings.
 */
const addFontControlAttribute = ( settings, name ) => {
	// Do nothing if it's another block than our defined ones.
	if ( ! enableFontControlOnBlocks.includes( name ) ) {
		return settings;
	}

	// Use Lodash's assign to gracefully handle if attributes are undefined
	settings.attributes = assign( settings.attributes, {
		typeFonts: {
			type: 'string',
			default:  '',
		},
	} );

	return settings;
};

addFilter( 'blocks.registerBlockType', 'extend-block-example/attribute/Font', addFontControlAttribute );

/**
 * Create HOC to add Font control to inspector controls of block.
 */
const withFontControl = createHigherOrderComponent( ( BlockEdit, ) => {

	return ( props ) => {

		const {
			name,
			isSelected,
		} = props;
		const { typeFonts} = props.attributes;


			const classes =  classnames( {
				[`${typeFonts}`]: typeFonts,
		
			});
		return (
			<Fragment>
				<BlockEdit { ...props } className={ classes } />
				{ isSelected && enableFontControlOnBlocks.includes( name ) &&
				<InspectorControls>
					<PanelBody
						title={ __( 'Font Control' ) }
						initialOpen={ true }
					>
					
                        <SelectControl
						label={ __( 'Fonts' ) }
						value={ typeFonts }
						options={ typeFontsControlOptions }
						onChange={ ( typeSelectedFontOption ) => {
							props.setAttributes( {
								typeFonts: typeSelectedFontOption,
								
							} );
						} }
					/>
						
					</PanelBody>
				</InspectorControls>
			}
			
			</Fragment>	
			
		);

	};
	
}, 'withFontControl' );

addFilter( 'editor.BlockEdit', 'extend-block-example/with-Font-control', withFontControl );


/**
 * Add custom element class in save element.
 *
 * @param {Object} extraProps     Block element.
 * @param {Object} blockType      Blocks object.
 * @param {Object} attributes     Blocks attributes.
 *
 * @return {Object} extraProps Modified block element.
 */
 function applyExtraClass( extraProps, blockType, attributes ) {

	const { typeFonts } = attributes;
	const classes =  classnames( {
		[`${typeFonts}`]: typeFonts,

	});
	//check if attribute exists for old Gutenberg version compatibility
	//add class only when visibleOnMobile = false
	//add allowedBlocks restriction
	
	extraProps.className = classnames( extraProps.className, classes );
	
	
	
	return extraProps;
	
}
addFilter(
	'blocks.getSaveContent.extraProps',
	'editorskit/applyExtraClass',
	applyExtraClass
);