<!DOCTYPE html>
<html lang="en">

<head>
  <title>Base CSS</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="<?= URLROOT; ?>/css/base.css">
  <style>
    [class*='col-'] {
      border: 1px dashed #e1e1e8;
      padding: 10px;
    }

    .info {
      line-height: 1.7;
    }

    code {
      padding: 1px 4px;
      border: 1px solid #ebeaea;
      background-color: #fafafa;
    }

    /* Desktop style overrides */
    @media (min-width: 1200px) {
      #location2FormGroup {
        width: 300px;
      }
    }
  </style>
</head>

<body>
  <div class="container">

    <h1>Base CSS</h1>
    <section>
      <p class="info">A simple CSS theme to kick start your project. Provides a consistent responsive style across mobile and desktop browsers for the base HTML elements. The popular <a href="https://fonts.google.com/specimen/Open+Sans">Open Sans font</a> is used to keep the text consistent between browsers.</p>

      <p class="info">Designed for Chrome, Firefox, Safari and IE9+</p>

      <p><a href="https://github.com/ianc1/BaseCSS">View on GitHib</a></p>
    </section>

    <section>
      <h3><a name="GetStarted" href="#GetStarted">Get Started</a></h3>
      <p class="info">To use Base CSS in your project, include the below CDN links in your HTML. Alternatively you can self-host by installing the <a href="https://www.npmjs.com/package/base-css-theme">NPM package</a> in your project.</p>
      <pre>
&lt;link href=&quot;https://unpkg.com/base-css-theme@1.1.3/base.css&quot; rel=&quot;stylesheet&quot;&gt;
&lt;script src=&quot;https://unpkg.com/base-css-theme@1.1.3/base.js&quot;&gt;&lt;/script&gt;

npm install --save-dev base-css-theme
</pre>
    </section>


    <section>
      <h3><a name="HTML5Doctype" href="#HTML5Doctype">HTML5 Doctype</a></h3>
      <p class="info">Base CSS makes use of certain HTML elements and CSS properties that require the use of the HTML5 doctype. Include it at the beginning of all your projects.</p>
      <pre>
&lt;!DOCTYPE html&gt;
&lt;html lang=&quot;en&quot;&gt;
  ...
&lt;/html&gt;
</pre>
    </section>


    <section>
      <h3><a name="Viewport" href="#Viewport">Viewport</a></h3>
      <p class="info">Base CSS is mobile first. To ensure proper rendering and touch zooming, add the <code>viewport</code> meta tag inside the <code>head</code> element.</p>
      <pre>
&lt;meta name=&quot;viewport&quot; content=&quot;width=device-width, initial-scale=1, shrink-to-fit=no&quot;&gt;
</pre>
    </section>


    <section>
      <h3><a name="Container" href="#Container">Container</a></h3>
      <p class="info">Use <code>container</code> for a responsive fixed width container.</p>
      <pre>
&lt;div class=&quot;container&quot;&gt;
  ...
&lt;/div&gt;
</pre>
    </section>


    <section>
      <h3><a name="MediaQueries" href="#MediaQueries">Media Queries</a></h3>
      <p class="info">The following media query is used to apply alternate styles for desktop devices.</p>
      <pre>
@media (min-width: 1200px) { 
  ...
}
</pre>
    </section>


    <section>
      <h3><a name="Headings" href="#Headings">Headings</a></h3>
      <h1>Heading 1</h1>
      <h2>Heading 2</h2>
      <h3>Heading 3</h3>
      <h4>Heading 4</h4>
      <h5>Heading 5</h5>
      <h6>Heading 6</h6>

      <h5>HTML</h5>
      <pre>
&lt;h1&gt;Heading 1&lt;/h1&gt;
&lt;h2&gt;Heading 2&lt;/h2&gt;
&lt;h3&gt;Heading 3&lt;/h3&gt;
&lt;h4&gt;Heading 4&lt;/h4&gt;
&lt;h5&gt;Heading 5&lt;/h5&gt;
&lt;h6&gt;Heading 6&lt;/h6&gt;
</pre>
    </section>


    <section>
      <h3><a name="Paragraph" href="#Paragraph">Paragraph</a></h3>
      <p class="info">Normal text, <strong>Strong text</strong>, <u>Underlined text</u>, <i>Italic text</i>, <small>Small text</small></p>
      <p class="info">Lorem ipsum dolor sit amet, adipiscing elit. Nullam dignissim convallis est. Quisque aliquam. Donec faucibus. Nunc iaculis suscipit dui. Nam sit amet sem. Aliquam libero nisi, imperdiet at, tincidunt nec, gravida vehicula, nisl. Praesent mattis, massa quis luctus fermentum, turpis mi volutpat justo, eu volutpat enim diam eget metus. Maecenas ornare tortor. Donec sed tellus eget sapien fringilla nonummy. Mauris a ante. Suspendisse quam sem, consequat at, commodo vitae, feugiat in, nunc. Morbi imperdiet augue quis tellus.</p>
      <p class="info">Lorem ipsum dolor sit amet, emphasis consectetuer adipiscing elit. Nullam dignissim convallis est. Quisque aliquam. Donec faucibus. Nunc iaculis suscipit dui. Nam sit amet sem. Aliquam libero nisi, imperdiet at, tincidunt nec, gravida vehicula, nisl. Praesent mattis, massa quis luctus fermentum, turpis mi volutpat justo, eu volutpat enim diam eget metus. Maecenas ornare tortor. Donec sed tellus eget sapien fringilla nonummy. Mauris a ante. Suspendisse quam sem, consequat at, commodo vitae, feugiat in, nunc. Morbi imperdiet augue quis tellus.</p>

      <h5>HTML</h5>
      <pre>
&lt;p&gt;Normal text, &lt;strong&gt;Strong text&lt;/strong&gt;, &lt;u&gt;Underlined text&lt;/u&gt;, &lt;i&gt;Italic text&lt;/i&gt;, &lt;small&gt;Small text&lt;/small&gt;&lt;/p&gt;
</pre>
    </section>


    <section>
      <h3><a name="Icons" href="#Icons">Icons</a></h3>
      <p class="info">The Google Material icon collection is included. A list of available icons can be found on their website <a href="https://material.io/icons/" target="_blank">https://material.io/icons/</a>.</p>
      <h1>
        <i class="icon">file_download</i>
        <i class="icon">archive</i>
        <i class="icon">cloud</i>
        <i class="icon">local_printshop</i>
      </h1>

      <h5>HTML</h5>
      <pre>
&lt;i class=&quot;icon&quot;&gt;file_download&lt;/i&gt;
</pre>
    </section>


    <section>
      <h3><a name="Lists" href="#Lists">Lists</a></h3>
      <h4>Unordered List</h4>
      <ul>
        <li>List Item 1</li>
        <li>List Item 2</li>
        <li>List Item 3</li>
      </ul>

      <h4>Ordered List</h4>
      <ol>
        <li>List Item 1</li>
        <li>List Item 2</li>
        <li>List Item 3</li>
      </ol>

      <h5>HTML</h5>
      <pre>
&lt;ul&gt;
  &lt;li&gt;List Item 1&lt;/li&gt;
  &lt;li&gt;List Item 2&lt;/li&gt;
  &lt;li&gt;List Item 3&lt;/li&gt;
&lt;/ul&gt;

&lt;ol&gt;
  &lt;li&gt;List Item 1&lt;/li&gt;
  &lt;li&gt;List Item 2&lt;/li&gt;
  &lt;li&gt;List Item 3&lt;/li&gt;
&lt;/ol&gt;
</pre>
    </section>


    <section>
      <h3><a name="Table" href="#Table">Table</a></h3>
      <table>
        <thead>
          <tr>
            <th>#</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th class="mobile-hide">Username</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th>1</th>
            <td>Mark</td>
            <td>Otto</td>
            <td class="mobile-hide">@mdo</td>
          </tr>
          <tr>
            <th>2</th>
            <td>Jacob</td>
            <td>Thornton</td>
            <td class="mobile-hide">@fat</td>
          </tr>
          <tr>
            <th>3</th>
            <td>Larry</td>
            <td>Bird</td>
            <td class="mobile-hide">@twitter</td>
          </tr>
        </tbody>
      </table>

      <h5>HTML</h5>
      <pre>
&lt;table&gt;
  &lt;thead&gt;
    &lt;tr&gt;&lt;th&gt;#&lt;/th&gt;&lt;th&gt;First Name&lt;/th&gt;&lt;th&gt;Last Name&lt;/th&gt;&lt;th class=&quot;mobile-hide&quot;&gt;Username&lt;/th&gt;&lt;/tr&gt;
  &lt;/thead&gt;
  &lt;tbody&gt;
    &lt;tr&gt;&lt;th&gt;1&lt;/th&gt;&lt;td&gt;Mark&lt;/td&gt;&lt;td&gt;Otto&lt;/td&gt;&lt;td class=&quot;mobile-hide&quot;&gt;@mdo&lt;/td&gt;&lt;/tr&gt;
    &lt;tr&gt;&lt;th&gt;2&lt;/th&gt;&lt;td&gt;Jacob&lt;/td&gt;&lt;td&gt;Thornton&lt;/td&gt;&lt;td class=&quot;mobile-hide&quot;&gt;@fat&lt;/td&gt;&lt;/tr&gt;
    &lt;tr&gt;&lt;th&gt;3&lt;/th&gt;&lt;td&gt;Larry&lt;/td&gt;&lt;td&gt;Bird&lt;/td&gt;&lt;td class=&quot;mobile-hide&quot;&gt;@twitter&lt;/td&gt;&lt;/tr&gt;
  &lt;/tbody&gt;
&lt;/table&gt;
</pre>
    </section>


    <section>
      <h3><a name="Buttons" href="#Buttons">Buttons</a></h3>
      <h4>Basic</h4>
      <p><button class="primary">Save</button> <button>Cancel</button></p>

      <h4>Button Icons</h4>
      <p class="info">The Google Material icon collection can be used to add icons to buttons. A list of available icons can be found on their website <a href="https://material.io/icons/" target="_blank">https://material.io/icons/</a>.</p>
      <p><button class="primary"><i class="icon">file_download</i> Download</button></p>

      <h4>Icon Only Buttons</h4>
      <button class="icon-button"><i class="icon">account_box</i></button>
      <button class="icon-button"><i class="icon">cancel</i></button>
      <button class="icon-button"><i class="icon">edit</i></button>

      <h5>HTML</h5>
      <pre>
&lt;button class=&quot;primary&quot;&gt;Save&lt;/button&gt; &lt;button&gt;Cancel&lt;/button&gt;

&lt;button class=&quot;primary&quot;&gt;&lt;i class=&quot;icon&quot;&gt;file_download&lt;/i&gt; Download&lt;/button&gt;

&lt;button class=&quot;icon-button&quot;&gt;&lt;i class=&quot;icon&quot;&gt;account_box&lt;/i&gt;&lt;/button&gt;
</pre>
    </section>


    <section>
      <h3><a name="Forms" href="#Forms">Forms</a></h3>
      <p class="info">Forms use a full width stacked layout by default on all screen sizes. Add <code>inline</code> to the form to switch to a horizonal
        layout on large displays.</p>

      <h4>Stacked Form</h4>
      <form>
        <label for="title">Title</label>
        <div class="select">
          <select id="title">
            <option>Mr</option>
            <option>Mrs</option>
            <option>Miss</option>
          </select>
        </div>

        <label for="name">Name</label>
        <input id="name" type="text" placeholder="Name" value="Mark Otto">

        <label for="mobile">Mobile</label>
        <input id="mobile" type="tel" placeholder="Mobile Number">

        <label for="accept">Accept Terms</label>
        <div class="checkbox">
          <input id="accept" type="checkbox" checked>
          <span></span>
        </div>

        <label for="notes">Notes</label>
        <textarea id="notes" placeholder="Add some notes">One
Two
Three</textarea>
      </form>

      <h5>HTML</h5>
      <pre>
&lt;form&gt;
&lt;label for=&quot;title&quot;&gt;Title&lt;/label&gt;
&lt;div class=&quot;select&quot;&gt;
  &lt;select id=&quot;title&quot;&gt;
    &lt;option&gt;Mr&lt;/option&gt;
    &lt;option&gt;Mrs&lt;/option&gt;
    &lt;option&gt;Miss&lt;/option&gt;
  &lt;/select&gt;
&lt;/div&gt;

&lt;label for=&quot;name&quot;&gt;Name&lt;/label&gt;
&lt;input id=&quot;name&quot; type=&quot;text&quot; placeholder=&quot;Name&quot; value=&quot;Mark Otto&quot;&gt;

&lt;label for=&quot;mobile&quot;&gt;Mobile&lt;/label&gt;
&lt;input id=&quot;mobile&quot; type=&quot;tel&quot; placeholder=&quot;Mobile Number&quot;&gt;

&lt;label for=&quot;accept&quot;&gt;Accept Terms&lt;/label&gt;
&lt;div class=&quot;checkbox&quot;&gt;
  &lt;input id=&quot;accept&quot; type=&quot;checkbox&quot;&gt;
  &lt;span&gt;&lt;/span&gt;
&lt;/div&gt;

&lt;label for=&quot;notes&quot;&gt;Notes&lt;/label&gt;
&lt;textarea id=&quot;notes&quot; placeholder=&quot;Add some notes&quot;&gt;One
Two
Three&lt;/textarea&gt;
&lt;/form&gt;
</pre>

      <h4>Inline</h4>
      <p class="info">Add <code>inline</code> to the form to use a horizonal inline layout on large displays and a
        stacked layout on smaller displays.</p>

      <form class="inline">
        <label for="username">Username</label>
        <div class="select">
          <select id="username">
            <option>Mark_Otto</option>
            <option>Jacob_Thornton</option>
            <option>Larry_Bird</option>
          </select>
        </div>

        <label for="password">Password</label><input id="password" type="password" placeholder="Password" value="xxxxxx">

        <label for="rememberme">Remember Me</label>
        <div class="checkbox">
          <input id="rememberme" type="checkbox" checked>
          <span></span>
        </div>

        <button class="primary"><i class="icon">forward</i> Sign In</button>
      </form>

      <h5>HTML</h5>
      <pre>
&lt;form class=&quot;inline&quot;&gt;
  &lt;label for=&quot;username&quot;&gt;Username&lt;/label&gt;&lt;div class=&quot;select&quot;&gt;
    &lt;select id=&quot;username&quot;&gt;
      &lt;option&gt;Mark_Otto&lt;/option&gt;
      &lt;option&gt;Jacob_Thornton&lt;/option&gt;
      &lt;option&gt;Larry_Bird&lt;/option&gt;
    &lt;/select&gt;
  &lt;/div&gt;

  &lt;label for=&quot;password&quot;&gt;Password&lt;/label&gt;&lt;input id=&quot;password&quot; type=&quot;password&quot; placeholder=&quot;Password&quot; value=&quot;xxxxxx&quot;&gt;

  &lt;label for=&quot;rememberme&quot;&gt;Remember Me&lt;/label&gt;
  &lt;div class=&quot;checkbox&quot;&gt;
    &lt;input id=&quot;rememberme&quot; type=&quot;checkbox&quot; checked&gt;
    &lt;span&gt;&lt;/span&gt;
  &lt;/div&gt;

  &lt;button class=&quot;primary&quot;&gt;&lt;i class=&quot;icon&quot;&gt;forward&lt;/i&gt;Sign In&lt;/button&gt;
&lt;/form&gt;
</pre>

      <h4>Field Groups</h4>
      <p class="info">Use the <code>field-group</code> container to join multiple form fields together to create a custom field.
        Buttons must be inside a <code>field-buttons</code> container.</p>

      <h5>Stacked</h5>

      <form>
        <div class="field-group">
          <input type="url" value="http://google.com">
          <div class="field-buttons"><button class="primary">Go</button></div>
        </div>

        <div class="field-group">
          <input type="url" value="http://google.com">
          <div class="field-buttons">
            <button class="primary"><i class="icon">file_download</i></button>
            <button class="primary"><i class="icon">content_copy</i></button>
          </div>
        </div>

        <div class="field-group">
          <div class="select">
            <select>
              <option>Mr</option>
              <option>Mrs</option>
              <option>Miss</option>
            </select>
          </div>
          <input type="text" value="Smith">
        </div>

        <div class="field-group" id="shirtFormGroup">
          <div class="select">
            <select>
              <option>Size</option>
              <option>Small</option>
              <option>Medium</option>
            </select>
          </div>
          <input type="text" value="Shirt Text">
          <div class="select">
            <select>
              <option>Qty</option>
              <option>1</option>
              <option>2</option>
            </select>
          </div>
        </div>

        <div class="field-group" id="locationFormGroup">
          <div class="select">
            <select>
              <option>County</option>
              <option>US</option>
              <option>UK</option>
            </select>
          </div>
          <div class="select">
            <select>
              <option>State</option>
              <option>California</option>
              <option>Massachusetts</option>
              <option>Texas</option>
              <option>Washington</option>
            </select>
          </div>
          <input type="text" value="City">
          <div class="field-buttons"><button class="primary"><i class="icon">add</i></button></div>
        </div>
      </form>

      <h5>Inline</h5>

      <form class="inline">
        <div class="field-group">
          <input type="text" value="Tracking code">
          <div class="field-buttons"><button class="primary"><i class="icon">content_copy</i></button></div>
        </div>

        <div class="field-group">
          <div class="field-buttons"><button class="primary"><i class="icon">autorenew</i></button></div>
          <input type="text" value="New Secret">
          <div class="field-buttons"><button class="primary"><i class="icon">content_copy</i></button></div>
        </div>

        <div class="field-group">
          <div class="select">
            <select>
              <option>Mr</option>
              <option>Mrs</option>
              <option>Miss</option>
            </select>
          </div>
          <div class="field-icons">
            <i class="icon left">person</i>
            <input type="text" value="Smith" required>
          </div>
        </div>

        <div class="field-group" id="location2FormGroup">
          <input type="text" value="City">
          <div class="select">
            <select id="state">
              <option>State</option>
              <option>California</option>
              <option>Massachusetts</option>
              <option>Texas</option>
              <option>Washington</option>
            </select>
          </div>
          <div class="select">
            <select>
              <option>County</option>
              <option>US</option>
              <option>UK</option>
            </select>
          </div>
        </div>
      </form>

      <h5>HTML</h5>
      <pre>
&lt;h5&gt;Stacked&lt;/h5&gt;

&lt;form&gt;
  &lt;div class=&quot;field-group&quot;&gt;
      &lt;input type=&quot;url&quot; value=&quot;http://google.com&quot;&gt;
      &lt;div class=&quot;field-buttons&quot;&gt;&lt;button class=&quot;primary&quot;&gt;Go&lt;/button&gt;&lt;/div&gt;
  &lt;/div&gt;

  &lt;div class=&quot;field-group&quot;&gt;
      &lt;input type=&quot;url&quot; value=&quot;http://google.com&quot;&gt;
      &lt;div class=&quot;field-buttons&quot;&gt;
        &lt;button class=&quot;primary&quot;&gt;&lt;i class=&quot;icon&quot;&gt;file_download&lt;/i&gt;&lt;/button&gt;
        &lt;button class=&quot;primary&quot;&gt;&lt;i class=&quot;icon&quot;&gt;content_copy&lt;/i&gt;&lt;/button&gt;
      &lt;/div&gt;
  &lt;/div&gt;

  &lt;div class=&quot;field-group&quot;&gt;
      &lt;div class=&quot;select&quot;&gt;
        &lt;select&gt;
          &lt;option&gt;Mr&lt;/option&gt;
          &lt;option&gt;Mrs&lt;/option&gt;
          &lt;option&gt;Miss&lt;/option&gt;
        &lt;/select&gt;
      &lt;/div&gt;
      &lt;input type=&quot;text&quot; value=&quot;Smith&quot;&gt;
  &lt;/div&gt;
&lt;/form&gt;


&lt;div class=&quot;field-group&quot; id=&quot;shirtFormGroup&quot;&gt;
  &lt;div class=&quot;select&quot;&gt;
    &lt;select&gt;
      &lt;option&gt;Size&lt;/option&gt;
      &lt;option&gt;Small&lt;/option&gt;
      &lt;option&gt;Medium&lt;/option&gt;
    &lt;/select&gt;
  &lt;/div&gt;
  &lt;input type=&quot;text&quot; value=&quot;Shirt Text&quot;&gt;
  &lt;div class=&quot;select&quot;&gt;
    &lt;select&gt;
      &lt;option&gt;Qty&lt;/option&gt;
      &lt;option&gt;1&lt;/option&gt;
      &lt;option&gt;2&lt;/option&gt;
    &lt;/select&gt;
  &lt;/div&gt;
&lt;/div&gt;

&lt;div class=&quot;field-group&quot; id=&quot;locationFormGroup&quot;&gt;
  &lt;div class=&quot;select&quot;&gt;
    &lt;select&gt;
      &lt;option&gt;County&lt;/option&gt;
      &lt;option&gt;US&lt;/option&gt;
      &lt;option&gt;UK&lt;/option&gt;
    &lt;/select&gt;
  &lt;/div&gt;
  &lt;div class=&quot;select&quot;&gt;
    &lt;select&gt;
      &lt;option&gt;State&lt;/option&gt;
      &lt;option&gt;California&lt;/option&gt;
      &lt;option&gt;Massachusetts&lt;/option&gt;
      &lt;option&gt;Texas&lt;/option&gt;
      &lt;option&gt;Washington&lt;/option&gt;
    &lt;/select&gt;
  &lt;/div&gt;
  &lt;input type=&quot;text&quot; value=&quot;City&quot;&gt;
  &lt;div class=&quot;field-buttons&quot;&gt;&lt;button class=&quot;primary&quot;&gt;&lt;i class=&quot;icon&quot;&gt;add&lt;/i&gt;&lt;/button&gt;&lt;/div&gt;
&lt;/div&gt;

&lt;h5&gt;Inline&lt;/h5&gt;

&lt;form class=&quot;inline&quot;&gt;
  &lt;div class=&quot;field-group&quot;&gt;
    &lt;input type=&quot;text&quot; value=&quot;Tracking code&quot;&gt;
    &lt;div class=&quot;field-buttons&quot;&gt;&lt;button class=&quot;primary&quot;&gt;&lt;i class=&quot;icon&quot;&gt;content_copy&lt;/i&gt;&lt;/button&gt;&lt;/div&gt;
  &lt;/div&gt;

  &lt;div class=&quot;field-group&quot;&gt;
    &lt;div class=&quot;field-buttons&quot;&gt;&lt;button class=&quot;primary&quot;&gt;&lt;i class=&quot;icon&quot;&gt;autorenew&lt;/i&gt;&lt;/button&gt;&lt;/div&gt;
    &lt;input type=&quot;text&quot; value=&quot;New Secret&quot;&gt;
    &lt;div class=&quot;field-buttons&quot;&gt;&lt;button class=&quot;primary&quot;&gt;&lt;i class=&quot;icon&quot;&gt;content_copy&lt;/i&gt;&lt;/button&gt;&lt;/div&gt;
  &lt;/div&gt;

  &lt;div class=&quot;field-group&quot;&gt;
    &lt;div class=&quot;select&quot;&gt;
      &lt;select&gt;
        &lt;option&gt;Mr&lt;/option&gt;
        &lt;option&gt;Mrs&lt;/option&gt;
        &lt;option&gt;Miss&lt;/option&gt;
      &lt;/select&gt;
    &lt;/div&gt;
    &lt;div class=&quot;field-icons&quot;&gt;
      &lt;i class=&quot;icon left&quot;&gt;person&lt;/i&gt;
      &lt;input type=&quot;text&quot; value=&quot;Smith&quot; required&gt;
    &lt;/div&gt;
  &lt;/div&gt;

  &lt;div class=&quot;field-group&quot; id=&quot;location2FormGroup&quot;&gt;
    &lt;input type=&quot;text&quot; id=&quot;city&quot; value=&quot;City&quot;&gt;
    &lt;div class=&quot;select&quot;&gt;
      &lt;select&gt;
        &lt;option&gt;State&lt;/option&gt;
        &lt;option&gt;California&lt;/option&gt;
        &lt;option&gt;Massachusetts&lt;/option&gt;
        &lt;option&gt;Texas&lt;/option&gt;
        &lt;option&gt;Washington&lt;/option&gt;
      &lt;/select&gt;
    &lt;/div&gt;
    &lt;div class=&quot;select&quot;&gt;
      &lt;select&gt;
        &lt;option&gt;County&lt;/option&gt;
        &lt;option&gt;US&lt;/option&gt;
        &lt;option&gt;UK&lt;/option&gt;
      &lt;/select&gt;
    &lt;/div&gt;
  &lt;/div&gt;
&lt;/form&gt;
</pre>

      <h4>Field Icons</h4>
      <p class="info">Add icons to a form field by placing the icons and the field inside a <code>field-icons</code> container.</p>

      <form class="inline">
        <div class="field-icons">
          <i class="icon left">phone_android</i>
          <input type="text" value="0800 123456">
        </div>

        <div class="field-icons">
          <i class="icon left">person</i>
          <i class="icon right">clear</i>
          <input type="text" value="Bob Smith">
        </div>
      </form>

      <h5>HTML</h5>
      <pre>
&lt;form class=&quot;inline&quot;&gt;
  &lt;div class=&quot;field-icons&quot;&gt;
    &lt;i class=&quot;icon left&quot;&gt;phone_android&lt;/i&gt;
    &lt;input type=&quot;text&quot; value=&quot;0800 123456&quot;&gt;
  &lt;/div&gt;

  &lt;div class=&quot;field-icons&quot;&gt;
    &lt;i class=&quot;icon left&quot;&gt;person&lt;/i&gt;
    &lt;i class=&quot;icon right&quot;&gt;clear&lt;/i&gt;
    &lt;input type=&quot;text&quot; value=&quot;Bob Smith&quot;&gt;
  &lt;/div&gt;
&lt;/form&gt;
</pre>

      <h4>Field Validation</h4>
      <p class="info">Use the input attribute <code>required</code> in conjunction with <code>type</code> to highlight invalid fields.
        Add feedback text using <code>field-feedback</code> inside a <code>field</code> container along with the input field.</p>

      <form class="inline">
        <input type="url" value="http\\www.google.com" required>

        <div class="field">
          <div class="field-icons">
            <i class="icon left">person</i>
            <i class="icon right">clear</i>
            <input type="email" value="bob@@acme.com" required>
          </div>
          <div class="field-feedback invalid">Invalid email address</div>
        </div>

        <div class="field">
          <input type="email" value="bob@acme.com" required>
          <div class="field-feedback">Enter a work email address</div>
        </div>
      </form>

      <h5>HTML</h5>
      <pre>
&lt;form class=&quot;inline&quot;&gt;
  &lt;input type=&quot;url&quot; value=&quot;http\\www.google.com&quot; required&gt;

  &lt;div class=&quot;field&quot;&gt;
    &lt;div class=&quot;field-icons&quot;&gt;
      &lt;i class=&quot;icon left&quot;&gt;person&lt;/i&gt;
      &lt;i class=&quot;icon right&quot;&gt;clear&lt;/i&gt;
      &lt;input type=&quot;email&quot; value=&quot;bob@@acme.com&quot; required&gt;
    &lt;/div&gt;
    &lt;div class=&quot;field-feedback invalid&quot;&gt;Invalid email address&lt;/div&gt;
  &lt;/div&gt;

  &lt;div class=&quot;field&quot;&gt;
    &lt;input type=&quot;email&quot; value=&quot;bob@acme.com&quot; required&gt;
    &lt;div class=&quot;field-feedback&quot;&gt;Enter a work email address&lt;/div&gt;
  &lt;/div&gt;
&lt;/form&gt;
</pre>

    </section>


    <section>
      <h3><a name="DropdownMenu" href="#DropdownMenu">Dropdown Menu</a></h3>
      <div class="dropdown">
        <button class="primary">Dropdown</button>
        <ul class="dropdown-menu">
          <li><a href="#item1">Item 1</a></li>
          <li><a href="#item2">Item 2</a></li>
          <li><a href="#item3">Item 3</a></li>
        </ul>
      </div>

      <h5>HTML</h5>
      <pre>
&lt;div class="dropdown"&gt;
  &lt;button class="primary"&gt;Dropdown&lt;/button&gt;
  &lt;ul class="dropdown-menu"&gt;
    &lt;li&gt;&lt;a href="#item1"&gt;Item 1&lt;/a&gt;&lt;/li&gt;
    &lt;li&gt;&lt;a href="#item2"&gt;Item 2&lt;/a&gt;&lt;/li&gt;
    &lt;li&gt;&lt;a href="#item3"&gt;Item 3&lt;/a&gt;&lt;/li&gt;
  &lt;/ul&gt;
&lt;/div&gt;
</pre>
    </section>


    <section>
      <h3><a name="Navbar" href="#Navbar">Navbar</a></h3>
      <nav class="navbar">
        <ul class="nav">
          <li><a href="#home">Acme Corp</a></li>
        </ul>
        <button class="icon-button dropdown"><i class="icon">menu</i></button>
        <div class="nav-collapse">
          <ul class="nav">
            <li><a href="#products">Products</a></li>
            <li><a href="#services">Services</a></li>
            <li><a href="#about">About</a></li>
          </ul>
          <ul class="nav nav-right">
            <li><a href="#account">John Smith</a></li>
            <li><a href="#logOut">Logout</a></li>
          </ul>
        </div>
      </nav>

      <h5>HTML</h5>
      <pre>
&lt;nav class=&quot;navbar&quot;&gt;
    &lt;ul class=&quot;nav&quot;&gt;
        &lt;li&gt;&lt;a href=&quot;#home&quot;&gt;Acme Corp&lt;/a&gt;&lt;/li&gt;
    &lt;/ul&gt;
    &lt;button class=&quot;icon-button dropdown&quot;&gt;&lt;i class=&quot;icon&quot;&gt;menu&lt;/i&gt;&lt;/button&gt;
    &lt;div class=&quot;nav-collapse&quot;&gt;
        &lt;ul class=&quot;nav&quot;&gt;
            &lt;li&gt;&lt;a href=&quot;#products&quot;&gt;Products&lt;/a&gt;&lt;/li&gt;
            &lt;li&gt;&lt;a href=&quot;#services&quot;&gt;Services&lt;/a&gt;&lt;/li&gt;
            &lt;li&gt;&lt;a href=&quot;#about&quot;&gt;About&lt;/a&gt;&lt;/li&gt;
        &lt;/ul&gt;
        &lt;ul class=&quot;nav nav-right&quot;&gt;
            &lt;li&gt;&lt;a href=&quot;#account&quot;&gt;John Smith&lt;/a&gt;&lt;/li&gt;
            &lt;li&gt;&lt;a href=&quot;#logOut&quot;&gt;Logout&lt;/a&gt;&lt;/li&gt;
        &lt;/ul&gt;
    &lt;/div&gt;
&lt;/nav&gt;
</pre>
    </section>


    <section>
      <h3><a name="Tabs" href="#Tabs">Tabs</a></h3>
      <div class="tabs">
        <input id="tab1" type="radio" name="tabs" checked>
        <label for="tab1">One</label>

        <input id="tab2" type="radio" name="tabs">
        <label for="tab2">Two</label>

        <input id="tab3" type="radio" name="tabs">
        <label for="tab3">Three</label>

        <section class="tab" id="tab1content">
          Tab one content
        </section>

        <section class="tab" id="tab2content">
          Tab two content
        </section>

        <section class="tab" id="tab3content">
          Tab three content
        </section>
      </div>

      <h5>HTML</h5>
      <pre>
&lt;div class=&quot;tabs&quot;&gt;
  &lt;input id=&quot;tab1&quot; type=&quot;radio&quot; name=&quot;tabs&quot; checked&gt;
  &lt;label for=&quot;tab1&quot;&gt;One&lt;/label&gt;
    
  &lt;input id=&quot;tab2&quot; type=&quot;radio&quot; name=&quot;tabs&quot;&gt;
  &lt;label for=&quot;tab2&quot;&gt;Two&lt;/label&gt;
    
  &lt;input id=&quot;tab3&quot; type=&quot;radio&quot; name=&quot;tabs&quot;&gt;
  &lt;label for=&quot;tab3&quot;&gt;Three&lt;/label&gt;
    
  &lt;section class=&quot;tab&quot; id=&quot;tab1content&quot;&gt;
    Tab one content
  &lt;/section&gt;

  &lt;section class=&quot;tab&quot; id=&quot;tab2content&quot;&gt;
    Tab two content
  &lt;/section&gt;

  &lt;section class=&quot;tab&quot; id=&quot;tab3content&quot;&gt;
    Tab three content
  &lt;/section&gt;
&lt;/div&gt;
</pre>
    </section>


    <section>
      <h3><a name="AlertsBanner" href="#AlertsBanner">Alerts Banner</a></h3>
      <div class="alerts-banner">
        <div class="alert alert-info">The requested operation has completed successfully.</div>
        <div class="alert alert-error">The requested operation could not be completed.</div>
      </div>

      <h5>HTML</h5>
      <pre>
&lt;div class=&quot;alerts-banner&quot;&gt;
  &lt;div class=&quot;alert alert-info&quot;&gt;The requested operation has completed successfully.&lt;/div&gt;
  &lt;div class=&quot;alert alert-error&quot;&gt;The requested operation could not be completed.&lt;/div&gt;
&lt;/div&gt;
</pre>
    </section>


    <section>
      <h3><a name="GridLayout" href="#GridLayout">Grid Layout</a></h3>
      <div class="row">
        <div class="col-1-8">col-1-8</div>
        <div class="col-1-8">col-1-8</div>
        <div class="col-1-8">col-1-8</div>
        <div class="col-1-8">col-1-8</div>
        <div class="col-1-8">col-1-8</div>
        <div class="col-1-8">col-1-8</div>
        <div class="col-1-8">col-1-8</div>
        <div class="col-1-8">col-1-8</div>
      </div>
      <div class="row">
        <div class="col-2-8">col-2-8</div>
        <div class="col-6-8">col-6-8</div>
      </div>
      <div class="row">
        <div class="col-4-8">col-4-8</div>
        <div class="col-4-8">col-4-8</div>
      </div>
      <div class="row">
        <div class="col-5-8">col-5-8</div>
        <div class="col-3-8">col-3-8</div>
      </div>
      <div class="row">
        <div class="col-7-8">col-7-8</div>
        <div class="col-1-8">col-1-8</div>
      </div>

      <h5>HTML</h5>
      <pre>
&lt;div class=&quot;row&quot;&gt;
  &lt;div class=&quot;col-1-8&quot;&gt;col-1-8&lt;/div&gt;
  &lt;div class=&quot;col-1-8&quot;&gt;col-1-8&lt;/div&gt;
  &lt;div class=&quot;col-1-8&quot;&gt;col-1-8&lt;/div&gt;
  &lt;div class=&quot;col-1-8&quot;&gt;col-1-8&lt;/div&gt;
  &lt;div class=&quot;col-1-8&quot;&gt;col-1-8&lt;/div&gt;
  &lt;div class=&quot;col-1-8&quot;&gt;col-1-8&lt;/div&gt;
  &lt;div class=&quot;col-1-8&quot;&gt;col-1-8&lt;/div&gt;
  &lt;div class=&quot;col-1-8&quot;&gt;col-1-8&lt;/div&gt;
&lt;/div&gt;
&lt;div class=&quot;row&quot;&gt;
  &lt;div class=&quot;col-2-8&quot;&gt;col-2-8&lt;/div&gt;
  &lt;div class=&quot;col-6-8&quot;&gt;col-6-8&lt;/div&gt;
&lt;/div&gt;
&lt;div class=&quot;row&quot;&gt;
  &lt;div class=&quot;col-4-8&quot;&gt;col-4-8&lt;/div&gt;
  &lt;div class=&quot;col-4-8&quot;&gt;col-4-8&lt;/div&gt;
&lt;/div&gt;
&lt;div class=&quot;row&quot;&gt;
  &lt;div class=&quot;col-5-8&quot;&gt;col-5-8&lt;/div&gt;
  &lt;div class=&quot;col-3-8&quot;&gt;col-3-8&lt;/div&gt;
&lt;/div&gt;
&lt;div class=&quot;row&quot;&gt;
  &lt;div class=&quot;col-7-8&quot;&gt;col-7-8&lt;/div&gt;
  &lt;div class=&quot;col-1-8&quot;&gt;col-1-8&lt;/div&gt;
&lt;/div&gt;
</pre>
    </section>

  </div>

  <script src="<?= URLROOT; ?>/js/base.js"></script>
</body>

</html>