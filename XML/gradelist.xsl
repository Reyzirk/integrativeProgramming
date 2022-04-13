<?xml version="1.0" encoding="UTF-8"?>

<!--
    Document   : gradelist.xsl
    Created on : 3 April 2022, 2:16 am
    Author     : Poh Choo Meng
    Description:
        Purpose of transformation follows.
-->

<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
    <xsl:output method="html"/>
    <xsl:param name="beginIndex" tunnel="yes" as="xs:integer" select="0"/>
    <xsl:param name="endIndex" tunnel="yes" as="xs:integer" select="9999999"/>
    <xsl:param name="search" select="defaultstring"/>
    <xsl:param name="sortType" select="'grade'"/>
    <xsl:param name="sortOrder" select="'ascending'"/>
    <xsl:template match="grades">
        <xsl:for-each select="grade[contains(grade, $search) 
        or contains(minMark, $search) 
        or contains(maxMark, $search)]">
            <xsl:sort select="*[name()=$sortType]" order="{$sortOrder}"/>
            <xsl:if test="position() &gt; $beginIndex and position() &lt; $endIndex">
               <tr>
                    <xsl:attribute name="id">
                        <xsl:value-of select="@gradeID"/>
                    </xsl:attribute>
                    <td class='text-center'><xsl:value-of select="grade"/></td>
                    <td class='text-center'>
                        <xsl:value-of select="minMark"/>
                    </td>
                    <td class='text-center'>
                        <xsl:value-of select="maxMark"/>
                    </td>
                    <td class='text-center'>
                        <button class='btn btn-outline-warning'>
                            <xsl:attribute name="onclick">
                                <xsl:value-of select='concat("location.href=&apos;editgrade.php?id=",@gradeID,"&apos;")'/>
                            </xsl:attribute>
                            <i class="fa-solid fa-pen-to-square"></i> Modify
                        </button>
                        <button class='btn btn-outline-danger'>
                            <xsl:attribute name="onclick">
                                <xsl:value-of select='concat("deleteDataRecord(&apos;",@gradeID,"&apos;)")'/>
                            </xsl:attribute>
                            <i class="fa-solid fa-trash"></i> Delete
                        </button>
                        
                    </td>
                </tr>
                
            </xsl:if>
            
           
        </xsl:for-each>

    </xsl:template>

</xsl:stylesheet>
