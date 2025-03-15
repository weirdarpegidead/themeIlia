const { __ } = wp.i18n; // Internationalization
const { InspectorControls } = wp.blockEditor; // Block editor components
const { PanelBody, MediaUpload, MediaUploadCheck } = wp.components; // UI components
const { Fragment } = wp.element; // React component

// Extend the Column block
const addBackgroundImageControl = (settings, name) => {
    if (name !== 'core/column') {
        return settings; // Only apply to the Column block
    }

    const newSettings = {
        ...settings,
        attributes: {
            ...settings.attributes,
            backgroundImage: {
                type: 'string',
                default: '',
            },
        },
        edit: (props) => {
            const { attributes, setAttributes } = props;
            const { backgroundImage } = attributes;

            return (
                <Fragment>
                    {settings.edit(props)}
                    <InspectorControls>
                        <PanelBody title={__('Background Image Settings')} initialOpen={true}>
                            <MediaUploadCheck>
                                <MediaUpload
                                    onSelect={(media) => setAttributes({ backgroundImage: media.url })}
                                    allowedTypes={['image']}
                                    value={backgroundImage}
                                    render={({ open }) => (
                                        <button onClick={open}>
                                            {!backgroundImage ? __('Upload Background Image') : __('Replace Background Image')}
                                        </button>
                                    )}
                                />
                                {backgroundImage && (
                                    <button onClick={() => setAttributes({ backgroundImage: '' })}>
                                        {__('Remove Background Image')}
                                    </button>
                                )}
                            </MediaUploadCheck>
                        </PanelBody>
                    </InspectorControls>
                </Fragment>
            );
        },
        save: (props) => {
            const { attributes } = props;
            const { backgroundImage } = attributes;

            return settings.save(props);
        },
    };

    return newSettings;
};

wp.hooks.addFilter(
    'blocks.registerBlockType',
    'theme/column-background-image',
    addBackgroundImageControl
);
