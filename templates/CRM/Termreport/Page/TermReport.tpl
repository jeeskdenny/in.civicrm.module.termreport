<h3>Renewal Term Report</h3>

	{$args}
<table class="crm-info-panel">
    <tr>
      <th class="label">{ts}Term/Period{/ts}</th>
      <th class="label">{ts}Start Date{/ts}</th>
      <th class="label">{ts}End Date{/ts}</th>
    </tr>

    {foreach from=$result.values item=membership}
        <tr>
          <td>{$membership.period}</td>
          <td>{$membership.start_date}</td>
          <td>{$membership.end_date}</td>
        </tr>
    {/foreach}
    </tr>
</table>