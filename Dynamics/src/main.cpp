#include "ofMain.h"
#include "ofApp.h"

//========================================================================
int main( ){
	ofGLFWWindowSettings settings;
	settings.setSize(610, 310);
	settings.resizable = false;
	ofCreateWindow(settings);

	ofRunApp(new ofApp());
}