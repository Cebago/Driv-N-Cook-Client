export var REVISION = '116';
export var MOUSE = {LEFT: 0, MIDDLE: 1, RIGHT: 2, ROTATE: 0, DOLLY: 1, PAN: 2};
export var TOUCH = {ROTATE: 0, PAN: 1, DOLLY_PAN: 2, DOLLY_ROTATE: 3};
export var CullFaceNone = 0;
export var CullFaceBack = 1;
export var CullFaceFront = 2;
export var CullFaceFrontBack = 3;
export var FrontFaceDirectionCW = 0;
export var FrontFaceDirectionCCW = 1;
export var BasicShadowMap = 0;
export var PCFShadowMap = 1;
export var PCFSoftShadowMap = 2;
export var VSMShadowMap = 3;
export var FrontSide = 0;
export var BackSide = 1;
export var DoubleSide = 2;
export var FlatShading = 1;
export var SmoothShading = 2;
export var NoBlending = 0;
export var NormalBlending = 1;
export var AdditiveBlending = 2;
export var SubtractiveBlending = 3;
export var MultiplyBlending = 4;
export var CustomBlending = 5;
export var AddEquation = 100;
export var SubtractEquation = 101;
export var ReverseSubtractEquation = 102;
export var MinEquation = 103;
export var MaxEquation = 104;
export var ZeroFactor = 200;
export var OneFactor = 201;
export var SrcColorFactor = 202;
export var OneMinusSrcColorFactor = 203;
export var SrcAlphaFactor = 204;
export var OneMinusSrcAlphaFactor = 205;
export var DstAlphaFactor = 206;
export var OneMinusDstAlphaFactor = 207;
export var DstColorFactor = 208;
export var OneMinusDstColorFactor = 209;
export var SrcAlphaSaturateFactor = 210;
export var NeverDepth = 0;
export var AlwaysDepth = 1;
export var LessDepth = 2;
export var LessEqualDepth = 3;
export var EqualDepth = 4;
export var GreaterEqualDepth = 5;
export var GreaterDepth = 6;
export var NotEqualDepth = 7;
export var MultiplyOperation = 0;
export var MixOperation = 1;
export var AddOperation = 2;
export var NoToneMapping = 0;
export var LinearToneMapping = 1;
export var ReinhardToneMapping = 2;
export var Uncharted2ToneMapping = 3;
export var CineonToneMapping = 4;
export var ACESFilmicToneMapping = 5;

export var UVMapping = 300;
export var CubeReflectionMapping = 301;
export var CubeRefractionMapping = 302;
export var EquirectangularReflectionMapping = 303;
export var EquirectangularRefractionMapping = 304;
export var SphericalReflectionMapping = 305;
export var CubeUVReflectionMapping = 306;
export var CubeUVRefractionMapping = 307;
export var RepeatWrapping = 1000;
export var ClampToEdgeWrapping = 1001;
export var MirroredRepeatWrapping = 1002;
export var NearestFilter = 1003;
export var NearestMipmapNearestFilter = 1004;
export var NearestMipMapNearestFilter = 1004;
export var NearestMipmapLinearFilter = 1005;
export var NearestMipMapLinearFilter = 1005;
export var LinearFilter = 1006;
export var LinearMipmapNearestFilter = 1007;
export var LinearMipMapNearestFilter = 1007;
export var LinearMipmapLinearFilter = 1008;
export var LinearMipMapLinearFilter = 1008;
export var UnsignedByteType = 1009;
export var ByteType = 1010;
export var ShortType = 1011;
export var UnsignedShortType = 1012;
export var IntType = 1013;
export var UnsignedIntType = 1014;
export var FloatType = 1015;
export var HalfFloatType = 1016;
export var UnsignedShort4444Type = 1017;
export var UnsignedShort5551Type = 1018;
export var UnsignedShort565Type = 1019;
export var UnsignedInt248Type = 1020;
export var AlphaFormat = 1021;
export var RGBFormat = 1022;
export var RGBAFormat = 1023;
export var LuminanceFormat = 1024;
export var LuminanceAlphaFormat = 1025;
export var RGBEFormat = RGBAFormat;
export var DepthFormat = 1026;
export var DepthStencilFormat = 1027;
export var RedFormat = 1028;
export var RedIntegerFormat = 1029;
export var RGFormat = 1030;
export var RGIntegerFormat = 1031;
export var RGBIntegerFormat = 1032;
export var RGBAIntegerFormat = 1033;

export var RGB_S3TC_DXT1_Format = 33776;
export var RGBA_S3TC_DXT1_Format = 33777;
export var RGBA_S3TC_DXT3_Format = 33778;
export var RGBA_S3TC_DXT5_Format = 33779;
export var RGB_PVRTC_4BPPV1_Format = 35840;
export var RGB_PVRTC_2BPPV1_Format = 35841;
export var RGBA_PVRTC_4BPPV1_Format = 35842;
export var RGBA_PVRTC_2BPPV1_Format = 35843;
export var RGB_ETC1_Format = 36196;
export var RGB_ETC2_Format = 37492;
export var RGBA_ETC2_EAC_Format = 37496;
export var RGBA_ASTC_4x4_Format = 37808;
export var RGBA_ASTC_5x4_Format = 37809;
export var RGBA_ASTC_5x5_Format = 37810;
export var RGBA_ASTC_6x5_Format = 37811;
export var RGBA_ASTC_6x6_Format = 37812;
export var RGBA_ASTC_8x5_Format = 37813;
export var RGBA_ASTC_8x6_Format = 37814;
export var RGBA_ASTC_8x8_Format = 37815;
export var RGBA_ASTC_10x5_Format = 37816;
export var RGBA_ASTC_10x6_Format = 37817;
export var RGBA_ASTC_10x8_Format = 37818;
export var RGBA_ASTC_10x10_Format = 37819;
export var RGBA_ASTC_12x10_Format = 37820;
export var RGBA_ASTC_12x12_Format = 37821;
export var RGBA_BPTC_Format = 36492;
export var SRGB8_ALPHA8_ASTC_4x4_Format = 37840;
export var SRGB8_ALPHA8_ASTC_5x4_Format = 37841;
export var SRGB8_ALPHA8_ASTC_5x5_Format = 37842;
export var SRGB8_ALPHA8_ASTC_6x5_Format = 37843;
export var SRGB8_ALPHA8_ASTC_6x6_Format = 37844;
export var SRGB8_ALPHA8_ASTC_8x5_Format = 37845;
export var SRGB8_ALPHA8_ASTC_8x6_Format = 37846;
export var SRGB8_ALPHA8_ASTC_8x8_Format = 37847;
export var SRGB8_ALPHA8_ASTC_10x5_Format = 37848;
export var SRGB8_ALPHA8_ASTC_10x6_Format = 37849;
export var SRGB8_ALPHA8_ASTC_10x8_Format = 37850;
export var SRGB8_ALPHA8_ASTC_10x10_Format = 37851;
export var SRGB8_ALPHA8_ASTC_12x10_Format = 37852;
export var SRGB8_ALPHA8_ASTC_12x12_Format = 37853;
export var LoopOnce = 2200;
export var LoopRepeat = 2201;
export var LoopPingPong = 2202;
export var InterpolateDiscrete = 2300;
export var InterpolateLinear = 2301;
export var InterpolateSmooth = 2302;
export var ZeroCurvatureEnding = 2400;
export var ZeroSlopeEnding = 2401;
export var WrapAroundEnding = 2402;
export var NormalAnimationBlendMode = 2500;
export var AdditiveAnimationBlendMode = 2501;
export var TrianglesDrawMode = 0;
export var TriangleStripDrawMode = 1;
export var TriangleFanDrawMode = 2;
export var LinearEncoding = 3000;
export var sRGBEncoding = 3001;
export var GammaEncoding = 3007;
export var RGBEEncoding = 3002;
export var LogLuvEncoding = 3003;
export var RGBM7Encoding = 3004;
export var RGBM16Encoding = 3005;
export var RGBDEncoding = 3006;
export var BasicDepthPacking = 3200;
export var RGBADepthPacking = 3201;
export var TangentSpaceNormalMap = 0;
export var ObjectSpaceNormalMap = 1;

export var ZeroStencilOp = 0;
export var KeepStencilOp = 7680;
export var ReplaceStencilOp = 7681;
export var IncrementStencilOp = 7682;
export var DecrementStencilOp = 7683;
export var IncrementWrapStencilOp = 34055;
export var DecrementWrapStencilOp = 34056;
export var InvertStencilOp = 5386;

export var NeverStencilFunc = 512;
export var LessStencilFunc = 513;
export var EqualStencilFunc = 514;
export var LessEqualStencilFunc = 515;
export var GreaterStencilFunc = 516;
export var NotEqualStencilFunc = 517;
export var GreaterEqualStencilFunc = 518;
export var AlwaysStencilFunc = 519;

export var StaticDrawUsage = 35044;
export var DynamicDrawUsage = 35048;
export var StreamDrawUsage = 35040;
export var StaticReadUsage = 35045;
export var DynamicReadUsage = 35049;
export var StreamReadUsage = 35041;
export var StaticCopyUsage = 35046;
export var DynamicCopyUsage = 35050;
export var StreamCopyUsage = 35042;
