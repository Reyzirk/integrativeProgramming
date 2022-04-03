<?xml version="1.0" encoding="UTF-8"?>

<!--
    Document   : courselist.xsl
    Created on : 3 April 2022, 2:53 am
    Author     : User
    Description:
        Purpose of transformation follows.
-->

<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
    <xsl:output method="html"/>
    <xsl:param name="beginIndex" tunnel="yes" as="xs:integer" select="0"/>
    <xsl:param name="endIndex" tunnel="yes" as="xs:integer" select="9999999"/>
    <xsl:param name="search" select="defaultstring"/>
    <xsl:param name="sortType" select="'@code'"/>
    <xsl:param name="sortOrder" select="'ascending'"/>
    <xsl:template match="courses">
        <xsl:for-each select="course[contains(@code, $search) 
    or contains(name, $search)]">

            <xsl:sort select="@*[name()=$sortType]" order="{$sortOrder}"/>
            <xsl:if test="position() &gt; $beginIndex and position() &lt; $endIndex">
                <tr>
                    <xsl:attribute name="id">
                        <xsl:value-of select="@code"/>
                    </xsl:attribute>
                    <td class='text-center'>
                        <xsl:value-of select="@code"/>
                    </td>
                    <td class='text-center'>
                        <xsl:value-of select="name"/>
                    </td>
                    <td class='text-center'>
                        <button class='btn btn-outline-info'>
                            <xsl:attribute name="onclick">
                                <xsl:value-of select='concat("location.href=&apos;viewcourse.php?id=",@code,"&apos;")'/>
                            </xsl:attribute>
                            <i class="fa-solid fa-eye"></i> View
                        </button>
                        <button class='btn btn-outline-warning'>
                            <xsl:attribute name="onclick">
                                <xsl:value-of select='concat("location.href=&apos;editcourse.php?id=",@code,"&apos;")'/>
                            </xsl:attribute>
                            <i class="fa-solid fa-pen-to-square"></i> Modify
                        </button>
                        <button class='btn btn-outline-danger'>
                            <xsl:attribute name="onclick">
                                <xsl:value-of select='concat("deleteDataRecord(&apos;",@code,"&apos;)")'/>
                            </xsl:attribute>
                            <i class="fa-solid fa-trash"></i> Delete
                        </button>

                    </td>
                </tr>

            </xsl:if>


        </xsl:for-each>
        

    </xsl:template>

</xsl:stylesheet>

