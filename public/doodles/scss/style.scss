/// Create the same keyframes twice (for retrigger in pure CSS)
/// @author Gregor Adams
/// @param  {Keyword} $name - name of the animation (will be suffixed with --1 and --2)
@mixin double-keyframes($name) {
  // write the keyframe rules to the document root
  @at-root {
    // write the same keyframes twice
    @for $i from 1 through 2 {
      $keyframe-name: unquote($name + "--" + $i);

      @keyframes #{$keyframe-name} {
        @content;
      }
    }
  }
}
@import url(https://fonts.googleapis.com/css?family=Passion+One);
body {
  background: #D30215;
  overflow: hidden;
  margin: 0;
  font-family: 'Passion One', impact;
}
.bg {
  position: absolute;
  top: 0; right: 0; bottom: 0; left: 0;
  background: url('https://s3-us-west-2.amazonaws.com/s.cdpn.io/28359/marvel.jpg');
  background-size: 2000px auto;
  animation: fade 6s steps(30) forwards;

  @for $i from 1 through 2 {
    #retrigger--#{$i}:checked ~ & {
      animation-name: fade--#{$i};
    }
  }

  @include double-keyframes(fade) {
    0% {
      background-position: 0 0;
      opacity: 1;
    }
    50% {
      background-position: 4000% 4000%;
      opacity: 0.6;
    }
    100% {
      background-position: -4000% -4000%;
      opacity: 0;
    }
  }
}
.pane {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%) scaleY(1.3);
  perspective: 700px;
}

.rotate {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: 
    translate(-50%, -50%)
    rotate3d(1,-1,0,40deg)
    scale(2);
  transform-style: preserve-3d;
  animation: rotate 6s 2s forwards;
  @for $i from 1 through 2 {
    #retrigger--#{$i}:checked ~ .pane & {
      animation-name: rotate--#{$i};
    }
  }
  
  @include double-keyframes(rotate) {
    0% {
      transform: 
        translate(-50%, -50%)
        rotate3d(1,-1,0,40deg)
        scale(2);
    }
    50% {
      transform: 
        translate(-50%, -50%)
        rotate3d(0,-0,0,0deg)
        scale(1.1);
    }
    100% {
      transform: 
        translate(-50%, -50%)
        rotate3d(0,-0,0,0deg)
        scale(1);
    }
  }
}

.logo {
  position: absolute;
  top: 50%;
  left: 50%;
  transform-style: preserve-3d;
  transform: translate(-50%, -50%);;
  font-size: 9em;
  letter-spacing: -0.06em;
  animation: hide 8s linear forwards;
  padding: 0 0.2em;
  line-height: 1;
  border: 0.02em solid black;
   @for $i from 1 through 2 {
    #retrigger--#{$i}:checked ~ .pane & {
      animation-name: hide--#{$i};
    }
  }
    
  &:nth-child(1) {
    animation: change 8s steps(30) forwards;
     @for $i from 1 through 2 {
    #retrigger--#{$i}:checked ~ .pane & {
        animation-name: change--#{$i};
      }
    }
    background: url('https://s3-us-west-2.amazonaws.com/s.cdpn.io/28359/marvel.jpg');
    background-size: 2000px auto;
  
  -webkit-background-clip: text;
  -webkit-filter: 
    drop-shadow(0   -1px 0 black)
    drop-shadow(0    1px 0 black)
    drop-shadow(1px  0   0 black)
    drop-shadow(-1px 0   0 black);
 //-webkit-text-fill-color: rgba(150,150,0,0.3);
    color: transparent;

  }
  
  @for $i from 2 through 20 {
    &:nth-child(#{$i}) {
      transform: translate3d(-50%,-50%, $i *-1px);
    }
  }

 @include double-keyframes(hide) {
   0% {
     visibility: visible;
     opacity: 1;
   }
   100% {
     visibility: hidden;
     opacity: 0;
   }
 }
  
  @include double-keyframes(change) {
    0% {
      background-position: 0 0;
      color: rgba(150,150,0,0.4);
      -webkit-filter: 
    drop-shadow( 0  -1px 0 black)
    drop-shadow( 0   1px 0 black)
    drop-shadow( 1px 0   0 black)
    drop-shadow(-1px 0   0 black);
      border-color: black;
    }
    50% {
      background-position: 200% 200%;
      color: rgba(150,150,0,0.4);
      -webkit-filter: 
    drop-shadow( 0  -1px 0 black)
    drop-shadow( 0   1px 0 black)
    drop-shadow( 1px 0   0 black)
    drop-shadow(-1px 0   0 black);
      border-color: white;

    }
    100% {
      background-position: -200% -200%;
      color: white;
      -webkit-filter: 
    drop-shadow(0 0 0 white)
    drop-shadow(0 0 0 white)
    drop-shadow(0 0 0 white)
    drop-shadow(0 0 0 white);
      border-color: white;

    }
  }
}




// hide the radios that allow us to retrigger the animation
.retrigger {
  position: absolute;
  left: -5em;
  opacity: 0;
}

// the section containing the retrigger button
@include double-keyframes(buttons) {
  0%,99% {
    visibility: hidden;
  }
  100% {
    visibility: visible;
  }
}
.buttons {
  position: absolute;
  z-index: 3;
  top: 1em;
  left: 50%;
  width: 10em;
  margin-left: -5em;
  height: 2em;
  line-height: 2em;
  text-align: center;
  cursor: pointer;
  user-select: none;
  animation: button 8s linear;
  @for $i from 1 through 2 {
    #retrigger--#{$i}:checked ~ & {
      animation-name: buttons--#{$i};
    }
  }
  
  // the labels are disguised as buttons
  .button {
    padding: 0.3em 1em;
    color: black;
    font-size: 1.3em;
    display: none;
    cursor: pointer;
    border: 2px solid black;
    &:hover {
      color: white;
      background: black;
    }
    // display the label for the unchecked input
    @for $i from 1 through 2 {
      &--#{$i} {
        #retrigger--#{$i % 2 + 1}:checked ~ & {
          display: block;
        }
      }
    }
  }
}