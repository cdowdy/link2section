Bolt Twig Filter for Section/Header Linking
======================
 
This adds a Twig filter to bolt that allows you to link to sections with a header. This is useful for sharing a link to a particular part of a blog post or article.  

## The Filter  
The filter used in your headings is 'l2s'. That is a lowercase L followed by a '2' and an 's'.  

```twig  
{{ 'my heading text'|l2s('theID', 'The classes', 'The Link Text', wrapping - true or false') }}
```  




### Filter Options Explanation:  
__'theID'__  
This is the ID of the "parent" element. Most instances this will be your headings (h1 through h6).  
```html  
<h1 id="theID"></h1>
```  
__At Minimum you need to supply an 'id'. Without an ID your regular heading will be rendered without an anchor tag__   

You will place this id as the first argument to the filter.  
```twig  
<h1 id="theID">  
  {{ Your Heading|l2s('theID') }}
</h1>
```  
__'The Classes'__  
The are the classes you'll want to use to style the anchor element that will either wrap the heading text or the anchor that is positioned after the heading. If you aren't using any classes then use ``''`` in place of the class argument.  

```twig  
{# passing classes #}
<h1 id="theID">  
  {{ Your Heading|l2s('theID', 'anchorStyles' ) }}
</h1>
```  

```twig  
{# not passing any classes #}
<h1 id="theID">  
  {{ Your Heading|l2s('theID', '' ) }}
</h1>
```  

__'The Link Text'__  
If your anchor is not wrapping (see next option) then you'll want to either supply text used in the anchor tag. See 'Icon Usage' below for a complete example. This defaults to the word: ``Link``  

```twig  
<h1 id="theID">  
  {{ Your Heading|l2s('theID', 'anchorStyles', 'Link' ) }}
</h1>
```  

__'Wrapping'__
A boolean (true or false) if the anchor should wrap your heading text. This defaults to ``TRUE``. This means each filter by default will wrap the heading text in an anchor tag.  

```twig  
<h1 id="theID">{{ record.title|l2s('theID') }}</h1>
```  
Default Result:  

```html  
<h1 id="theID">  
  <a href="#theID">Record Ttle</a>  
</h1>  
```  

Setting it to FALSE:  

```twig  
<h1 id="theID">{{ record.title|l2s('theID', 'anchorStyles', 'Link', false ) }}</h1>
```  
False result:  

```html  
<h1 id="theID">  
  Record Title  
    <a href="#theID" aria-label="Link To Section 'Record Title'" class="anchorStyles">Link</a>  
</h1>  
```



## Examples  
In your twig templates or contentType editor wherever you have a Heading and wish to be able to link to that heading, you first give your heading an ID:  

```twig  
<h1 id="myID"></h1>
```  

inside the ``h1`` element where you might typically place ``{{ record.title }}`` or your own heading text use the provided filter followed by the id.  

```twig  
<h1 id="myID">{{ record.title|l2s( 'myId', 'myClass' ) }}</h1>
```  

This will is what is sent to the browser:  

```html  
<h1 id="myID"><a href="#myId" class="myClass">Qui convenit?</a></h1>
```  

### Usage With Icons  
If You're using Icons to denote a link (as seen on [Smashing Magazine](https://www.smashingmagazine.com/2017/07/designing-perfect-date-time-picker/#date-picker-design-considerations) ), You'll need to make ``wrapping`` equal to false. Here is a quick example.   

```css  
/** example of css used. Your's will probably vary a lot */ 

.screen-reader {
    overflow: hidden;
    white-space: nowrap;
    text-indent: 200%;
    height: .008em;
    width: .008em;
}
.link-icon {
    display: inline-block;
    margin-left: .125em;
    width: .6em;
    height: .6em;
    background: url('/theme/base-2016/images/link.png') no-repeat;
    background-size: contain;
    opacity: .25;
    transition: opacity .3s;
}
.link-icon:hover,
.link-icon:focus,
.link-icon:active {
    opacity: .85;
}
```  
```twig  
{# your twig template or contentType editor #}  
<h1 id="myLinkIcon">
  {{ record.title|l2s('myLinkIcon', 'screen-reader link-icon', '', false) }}
</h1>
```  
Result:  

```html  
<h1 id="myLinkIcon">Qui convenit? <a href="#myLinkIcon" aria-label="Link To Section 'Qui convenit?'" class="screen-reader link-icon">Link</a>
</h1>
```  
Example Result Screenshot:  
![Using Icon with a wrapped header](https://raw.githubusercontent.com/cdowdy/link2section/master/screenshots/wrapping-icon-readme.png)