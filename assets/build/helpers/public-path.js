/* eslint-env browser */
/* globals kennystevens_DIST_PATH */

/** Dynamically set absolute public path from current protocol and host */
if (kennystevens_DIST_PATH) {
  __webpack_public_path__ = kennystevens_DIST_PATH; // eslint-disable-line no-undef, camelcase
}
